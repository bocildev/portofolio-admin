<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Iam\Client\Claims;
use Iam\Client\TokenVerifier;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class IamSsoService
{
    public function issuer(): string
    {
        return rtrim((string) config('iam.issuer', 'http://iam-sso-core.test:8888'), '/');
    }

    public function clientId(): string
    {
        return (string) config('iam.client_id', 'app_portfolio_admin');
    }

    public function getJwks(bool $forceRefresh = false): array
    {
        $cacheKey = 'iam_oidc_jwks_'.md5($this->issuer());
        if ($forceRefresh) {
            Cache::forget($cacheKey);
        }

        return Cache::remember($cacheKey, 600, function () {
            $res = Http::timeout(8)->acceptJson()->get($this->issuer().'/oauth/jwks');
            if (! $res->successful()) {
                throw new RuntimeException('Gagal mengambil JWKS dari IAM-SSO-CORE ('.$res->status().')');
            }

            return $res->json();
        });
    }

    public function isSessionActiveInIam(?string $accessToken): bool
    {
        if (! $accessToken) {
            return false;
        }

        if (app()->runningUnitTests()) {
            return true;
        }

        try {
            $res = Http::timeout(4)
                ->withToken($accessToken)
                ->acceptJson()
                ->get($this->issuer().'/oauth/userinfo');

            return $res->successful();
        } catch (\Throwable) {
            return false;
        }
    }

    public function verifyAccessToken(string $jwt): Claims
    {
        try {
            $verifier = new TokenVerifier($this->issuer(), $this->clientId(), $this->getJwks(false));

            return $verifier->verifyAccessToken($jwt);
        } catch (\Throwable) {
            $verifier = new TokenVerifier($this->issuer(), $this->clientId(), $this->getJwks(true));

            return $verifier->verifyAccessToken($jwt);
        }
    }

    public function exchangeAuthorizationCode(string $code, string $codeVerifier, string $redirectUri): array
    {
        $res = Http::timeout(10)->acceptJson()->post($this->issuer().'/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId(),
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'code_verifier' => $codeVerifier,
        ]);

        if (! $res->successful()) {
            $err = $res->json();
            throw new RuntimeException($err['error_description'] ?? $err['error'] ?? 'Gagal menukar authorization code.');
        }

        $tokenData = $res->json();
        $claims = $this->verifyAccessToken($tokenData['access_token']);

        $userInfo = [];
        try {
            $infoRes = Http::timeout(8)
                ->withToken($tokenData['access_token'])
                ->acceptJson()
                ->get($this->issuer().'/oauth/userinfo');
            if ($infoRes->successful()) {
                $userInfo = $infoRes->json();
            }
        } catch (\Throwable) {
            // Fallback ke klaim JWT
        }

        $user = $this->syncUser(
            $claims,
            (string) ($userInfo['name'] ?? 'Portfolio Admin'),
            (string) ($userInfo['email'] ?? '')
        );

        return [
            'tokens' => $tokenData,
            'claims' => $claims,
            'user' => $user,
        ];
    }

    public function directLogin(string $email, string $password): array
    {
        $res = Http::timeout(10)->acceptJson()->post($this->issuer().'/oauth/direct-login', [
            'client_id' => $this->clientId(),
            'email' => $email,
            'password' => $password,
        ]);

        if (! $res->successful()) {
            $err = $res->json();
            throw new RuntimeException($err['error_description'] ?? $err['error'] ?? 'Email atau password tidak sesuai.');
        }

        $tokenData = $res->json();
        $claims = $this->verifyAccessToken($tokenData['access_token']);
        $userInfo = $tokenData['user'] ?? [];

        $user = $this->syncUser(
            $claims,
            (string) ($userInfo['name'] ?? 'Portfolio Admin'),
            (string) ($userInfo['email'] ?? $email)
        );

        return [
            'tokens' => $tokenData,
            'claims' => $claims,
            'user' => $user,
        ];
    }

    public function syncUser(Claims $claims, ?string $name = null, ?string $email = null): User
    {
        $email = $email ?: ($claims->sub.'@iam-sso.local');
        $name = $name ?: 'Portfolio Admin';

        $user = User::where('sub', $claims->sub)->first();
        if (! $user && $email) {
            $user = User::where('email', $email)->first();
        }

        if (! $user) {
            $user = new User();
            $user->sub = $claims->sub;
        }

        $user->name = $name;
        $user->email = $email;
        $user->roles = $claims->roles;
        $user->permissions = $claims->permissions;
        $user->save();

        return $user;
    }
}
