<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\IamSsoService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireSsoSession
{
    public function __construct(private IamSsoService $sso) {}

    public function handle(Request $request, Closure $next, ?string $requiredPermission = null): Response
    {
        $sessionUser = $request->session()->get('iam_user');
        if (! $sessionUser || empty($sessionUser['sub'])) {
            return redirect()->route('login');
        }

        $accessToken = (string) $request->session()->get('iam_access_token', '');
        if ($accessToken !== '' && ! $this->sso->isSessionActiveInIam($accessToken)) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $request->session()->flash('silent_sso_checked', true);

            return redirect()->route('login', ['manual' => 1])->withErrors([
                'sso' => 'Sesi Anda telah dicabut oleh Administrator atau Anda telah keluar dari SSO.',
            ]);
        }

        $dbUser = User::where('sub', $sessionUser['sub'])->first();
        if (! $dbUser) {
            $request->session()->forget(['iam_user', 'iam_access_token']);

            return redirect()->route('login')->withErrors([
                'sso' => 'Akun SSO Anda tidak ditemukan di sistem portofolio.',
            ]);
        }

        $roles = (array) ($dbUser->roles ?? []);
        $permissions = (array) ($dbUser->permissions ?? []);

        $userContext = [
            'sub' => $dbUser->sub,
            'name' => $dbUser->name,
            'email' => $dbUser->email,
            'roles' => $roles,
            'permissions' => $permissions,
        ];

        $request->session()->put('iam_user', $userContext);
        $request->attributes->set('iam_user', $userContext);

        if ($requiredPermission && ! $this->hasPermission($permissions, $requiredPermission)) {
            return response()->view('auth.restricted', [
                'user' => $userContext,
                'portoUrl' => config('iam.porto_url'),
            ], 403);
        }

        return $next($request);
    }

    private function hasPermission(array $permissions, string $required): bool
    {
        return in_array('*', $permissions, true) || in_array($required, $permissions, true);
    }
}
