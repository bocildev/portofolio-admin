<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MotionConfig;
use App\Models\MotionProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MotionApiController extends Controller
{
    public function portfolio(Request $request): JsonResponse
    {
        $profile = MotionConfig::getValue('profile', []);
        $skills = MotionConfig::getValue('skills', []);
        $softwareTools = MotionConfig::getValue('software_tools', []);
        $experiences = MotionConfig::getValue('experiences', []);

        $projects = MotionProject::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'profile' => $profile,
            'projects' => $projects,
            'skills' => $skills,
            'softwareTools' => $softwareTools,
            'experiences' => $experiences,
            '_auth' => [
                'authenticated' => true,
                'client_app' => 'Motion Portfolio Nuxt 3 Client',
                'api_source' => 'portfolio-admin (Laravel 11+)',
                'timestamp' => now()->toIso8601String(),
            ],
        ]);
    }

    public function projects(Request $request): JsonResponse
    {
        $projects = MotionProject::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json($projects);
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
            'project' => $project,
        ]);
    }

    public function saveConfig(Request $request): JsonResponse
    {
        $data = $request->validate([
            'key' => 'required|string',
            'value' => 'required',
        ]);

        $config = MotionConfig::setValue($data['key'], $data['value']);

        return response()->json([
            'success' => true,
            'config' => $config,
        ]);
    }
}
