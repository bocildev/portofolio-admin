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

        // Pastikan atribut pelengkap profil terisi
        if (empty($profile['cvFiles'])) {
            $profile['cvFiles'] = [
                ['label' => 'Download CV Fullstack', 'role' => 'Fullstack Developer', 'url' => '/cv/Fullstack_Moch_Adam_Athallahrich.pdf'],
                ['label' => 'Download CV Frontend', 'role' => 'Frontend Developer', 'url' => '/cv/Frontend_Moch_Adam_Athallahrich.pdf'],
            ];
        }
        if (empty($profile['education'])) {
            $profile['education'] = [
                'school' => 'SMK Telkom Malang',
                'major' => 'Software Engineering (Rekayasa Perangkat Lunak)',
                'period' => '2016 — 2019',
            ];
        }
        if (empty($profile['whatsappUrl']) && !empty($profile['phone'])) {
            $cleanPhone = preg_replace('/[^0-9]/', '', $profile['phone']);
            $profile['whatsappUrl'] = "https://wa.me/{$cleanPhone}";
        }
        if (empty($profile['instagramHandle']) && !empty($profile['instagram'])) {
            $parts = explode('/', rtrim($profile['instagram'], '/'));
            $profile['instagramHandle'] = '@' . end($parts);
        }

        $stats = MotionConfig::getValue('stats', [
            ['value' => 6, 'suffix' => '+ Thn', 'label' => 'Pengalaman Industri', 'detail' => 'Sejak 2018 (Intern, Junior Dev hingga Fullstack di Telkomsigma)'],
            ['value' => 10, 'suffix' => '+', 'label' => 'Framework & Bahasa Utama', 'detail' => 'Vue 2/3, Nuxt 2/3, Flutter, React, CI3, Laravel, .NET, Android'],
            ['value' => 25, 'suffix' => '+ Modul', 'label' => 'Sistem Enterprise & POS', 'detail' => 'HCM MANGO, Performance Appraisal, Meikarta, POS & Sales'],
            ['value' => 14, 'suffix' => ' Tools', 'label' => 'Ekosistem Engineering', 'detail' => 'Docker, Oracle, Toad SQL, DBeaver, Navicat, Antigravity, Cursor'],
        ]);

        $roleLenses = MotionConfig::getValue('role_lenses', [
            ['id' => 'all', 'label' => 'All Expertise', 'badge' => 'Full Spectrum', 'headline' => 'Fullstack & Frontend Motion Engineer', 'summary' => 'Menggabungkan arsitektur aplikasi enterprise (Telkomsigma & Visionet), antarmuka reaktif Vue/Nuxt, dan ekosistem mobile Flutter/Android.'],
            ['id' => 'frontend', 'label' => 'Frontend & Web UI', 'badge' => 'Vue · Nuxt · React · Angular', 'headline' => 'Frontend Architect & Technical Researcher', 'summary' => 'Spesialis pembangunan antarmuka modern menggunakan Vue 2/3, Nuxt 2/3, React JS, AngularTS, Buefy, dan TailwindCSS serta riset teknis frontend.'],
            ['id' => 'fullstack', 'label' => 'Fullstack & Backend', 'badge' => 'CI3 · Laravel · .NET · Oracle', 'headline' => 'Enterprise Fullstack & Database Engineer', 'summary' => 'Berpengalaman membangun sistem HCM, Performance Appraisal, POS, dan Warehouse Sales dengan PHP Native, CodeIgniter, Laravel, .NET, Oracle, MySQL & SQL Server.'],
            ['id' => 'mobile', 'label' => 'Mobile Apps', 'badge' => 'Flutter · Android Native', 'headline' => 'Cross-Platform & Native Mobile Developer', 'summary' => 'Merancang aplikasi mobile pembayaran online, company profile, dan sistem kasir POS menggunakan Flutter dan Android Native (Java/XML).'],
        ]);

        $certifications = MotionConfig::getValue('certifications', [
            ['title' => 'SMK Telkom Malang — Software Engineering', 'issuer' => 'SMK Telkom Malang', 'year' => '2019', 'badge' => 'RPL Graduate', 'detail' => 'Kompetensi inti rekayasa perangkat lunak, algoritma, pemrograman berorientasi objek, basis data relasional, dan arsitektur web.'],
            ['title' => 'Technical Researcher & Frontend Specialist', 'issuer' => 'PT. Sigma Cipta Caraka (Telkomsigma)', 'year' => '2020 — Sekarang', 'badge' => 'Enterprise Active', 'detail' => 'Evaluasi teknologi antarmuka korporasi, standardisasi komponen Vue/Nuxt, dan pemeliharaan aplikasi internal skala besar.'],
            ['title' => 'Fullstack POS & Android Developer', 'issuer' => 'PT. Ara Infra Indo', 'year' => '2022 — 2023', 'badge' => 'Production POS', 'detail' => 'Implementasi arsitektur kasir Point of Sale berbasis Android Native Java/XML dan backend CodeIgniter 3.'],
        ]);

        $hobbies = MotionConfig::getValue('hobbies', [
            ['title' => 'Exploring New Frameworks', 'description' => 'Eksplorasi mendalam teknologi frontend, mobile (Flutter), dan AI-assisted engineering.', 'image' => '/hobbies/programming.webp'],
            ['title' => 'Touring & Riding', 'description' => 'Menjelajahi suasana baru untuk menjaga perspektif kreatif tetap segar.', 'image' => '/hobbies/riding.webp'],
            ['title' => 'Music Enthusiast', 'description' => 'Playlist koding favorit: MAN WITH A MISSION, HONNE, Forester, Milet, dan YOASOBI.', 'image' => '/hobbies/negative-space-headphones-black-white-corey-blaz.webp'],
        ]);

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
            'stats' => $stats,
            'roleLenses' => $roleLenses,
            'certifications' => $certifications,
            'hobbies' => $hobbies,
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
