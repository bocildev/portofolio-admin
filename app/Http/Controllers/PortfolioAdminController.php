<?php

namespace App\Http\Controllers;

use App\Models\MotionConfig;
use App\Models\MotionProject;
use App\Services\IamSsoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PortfolioAdminController extends Controller
{
    public function __construct(private IamSsoService $sso) {}

    public function index(Request $request)
    {
        $projects = MotionProject::orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();
        $profile = MotionConfig::getValue('profile', []);
        $skills = MotionConfig::getValue('skills', []);
        $softwareTools = MotionConfig::getValue('software_tools', []);
        $experiences = MotionConfig::getValue('experiences', []);
        $portfolioUrl = MotionConfig::getValue('portfolio_url', config('iam.porto_url', 'http://localhost:3000'));

        $user = $request->session()->get('iam_user', [
            'name' => 'Moch. Adam Athallahrich',
            'email' => 'athallahrich@gmail.com',
            'roles' => ['admin'],
        ]);

        return view('admin.dashboard', [
            'user' => $user,
            'title' => 'Portofolio Motion Control Center',
            'projects' => $projects,
            'profile' => $profile,
            'skills' => $skills,
            'softwareTools' => $softwareTools,
            'experiences' => $experiences,
            'portfolioUrl' => $portfolioUrl,
            'issuer' => $this->sso->issuer(),
            'clientId' => $this->sso->clientId(),
        ]);
    }

    public function saveProfile(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'shortName' => 'nullable|string',
            'roleTitle' => 'nullable|string',
            'currentCompany' => 'nullable|string',
            'birthInfo' => 'nullable|string',
            'location' => 'nullable|string',
            'cityTag' => 'nullable|string',
            'bioId' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'whatsappUrl' => 'nullable|string',
            'instagram' => 'nullable|string',
            'instagramHandle' => 'nullable|string',
            'gitlab' => 'nullable|string',
            'avatar' => 'nullable|string',
            'avatarAlt' => 'nullable|string',
            'cvFiles' => 'nullable|array',
            'techSpecs' => 'nullable|array',
        ]);

        $techSpecs = $request->input('techSpecs');
        if (! is_array($techSpecs)) {
            $techSpecs = [
                ['label' => 'Primary Stacks', 'value' => (string) $request->input('spec_primary_stacks', 'Vue 2/3 · NuxtJS · CI3')],
                ['label' => 'Database RDBMS', 'value' => (string) $request->input('spec_database', 'Oracle · MySQL · SSMS')],
                ['label' => 'Mobile Ecosystem', 'value' => (string) $request->input('spec_mobile', 'Flutter · Android Native')],
                ['label' => 'Experience Scope', 'value' => (string) $request->input('spec_experience', 'Enterprise & POS (6+ Yrs)')],
            ];
        }
        $existing = MotionConfig::getValue('profile', []);
        $merged = array_merge($existing, array_filter($data, fn ($v) => $v !== null));
        $merged['techSpecs'] = $techSpecs;
        $merged['cityTag'] = (string) ($request->input('cityTag') ?: 'SURABAYA, ID');

        MotionConfig::setValue('profile', $merged);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil disimpan.',
            'profile' => $merged,
        ]);
    }

    public function saveProject(Request $request): JsonResponse
    {
        $data = $request->validate([
            'id' => 'nullable|integer',
            'project_key' => 'nullable|string',
            'number' => 'nullable|string',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'company' => 'nullable|string',
            'period' => 'nullable|string',
            'category' => 'nullable|in:enterprise,personal',
            'roles' => 'nullable|array',
            'cover_image' => 'required|string',
            'logo' => 'nullable|string',
            'description' => 'nullable|string',
            'impact_highlights' => 'nullable|array',
            'tech_stack' => 'nullable|array',
            'team' => 'nullable|array',
            'live_url' => 'nullable|string',
            'repo_url' => 'nullable|string',
            'demo_credentials' => 'nullable|string',
            'gallery' => 'nullable|array',
            'display_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if (empty($data['project_key'])) {
            $data['project_key'] = Str::slug($data['title']);
        }

        $id = $data['id'] ?? null;
        unset($data['id']);

        if ($id) {
            $project = MotionProject::findOrFail($id);
            $project->update($data);
        } else {
            $project = MotionProject::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Studi kasus proyek berhasil disimpan.',
            'project' => $project,
        ]);
    }

    public function deleteProject(int $id): JsonResponse
    {
        $project = MotionProject::findOrFail($id);
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proyek berhasil dihapus.',
        ]);
    }

    public function saveSkills(Request $request): JsonResponse
    {
        $skills = $request->input('skills');
        if (! is_array($skills)) {
            $skills = json_decode((string) $skills, true) ?: [];
        }

        MotionConfig::setValue('skills', $skills);

        return response()->json([
            'success' => true,
            'message' => 'Matriks keahlian berhasil diperbarui.',
            'skills' => $skills,
        ]);
    }

    public function saveTools(Request $request): JsonResponse
    {
        $tools = $request->input('software_tools');
        if (! is_array($tools)) {
            $tools = json_decode((string) $tools, true) ?: [];
        }

        MotionConfig::setValue('software_tools', $tools);

        return response()->json([
            'success' => true,
            'message' => 'Software tools berhasil diperbarui.',
            'softwareTools' => $tools,
        ]);
    }

    public function saveExperiences(Request $request): JsonResponse
    {
        $experiences = $request->input('experiences');
        if (! is_array($experiences)) {
            $experiences = json_decode((string) $experiences, true) ?: [];
        }

        MotionConfig::setValue('experiences', $experiences);

        return response()->json([
            'success' => true,
            'message' => 'Rekam jejak pengalaman kerja berhasil diperbarui.',
            'experiences' => $experiences,
        ]);
    }

    public function savePortfolioUrl(Request $request): JsonResponse
    {
        $data = $request->validate([
            'url' => 'required|url',
        ]);

        MotionConfig::setValue('portfolio_url', $data['url']);

        return response()->json([
            'success' => true,
            'message' => 'URL Portofolio berhasil disimpan.',
            'url' => $data['url'],
        ]);
    }

    public function uploadMedia(Request $request): JsonResponse
    {
        if (! $request->hasFile('file')) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan pilih file untuk diunggah.',
            ], 422);
        }

        $file = $request->file('file');
        $folder = (string) $request->input('folder', 'portfolio');

        try {
            $issuer = config('iam.issuer', 'http://iam-sso-core.test:8888');
            $clientId = config('iam.client_id', 'app_portfolio_admin');

            $response = Http::timeout(60)
                ->withHeaders([
                    'X-Client-Id' => $clientId,
                    'Accept' => 'application/json',
                ])
                ->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->post("{$issuer}/api/v1/storage/upload", [
                    'folder' => $folder,
                ]);

            if ($response->successful()) {
                return response()->json($response->json(), 201);
            }

            $errData = $response->json();

            return response()->json([
                'success' => false,
                'message' => $errData['message'] ?? 'Gagal mengunggah file ke IAM Storage Engine.',
            ], $response->status());
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Koneksi ke IAM-SSO-CORE gagal: '.$e->getMessage(),
            ], 500);
        }
    }
}
