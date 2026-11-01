<?php

namespace Tests\Feature;

use App\Models\MotionConfig;
use App\Models\MotionProject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic config & projects for testing
        MotionConfig::setValue('profile', [
            'name' => 'Moch. Adam Athallahrich',
            'roleTitle' => 'Fullstack & Frontend Developer',
            'email' => 'athallahrich@gmail.com',
        ]);

        MotionConfig::setValue('skills', [
            ['name' => 'Vue 2 & Vue 3', 'level' => 85, 'category' => 'frontend'],
        ]);

        MotionConfig::setValue('software_tools', [
            ['name' => 'Visual Studio', 'badge' => 'Primary IDE'],
        ]);

        MotionProject::create([
            'project_key' => 'mango-hcm',
            'number' => '01',
            'title' => 'MANGO — Human Capital Management Online',
            'category' => 'enterprise',
            'cover_image' => '/work/sigma/mango/dashboard.png',
            'is_active' => true,
            'display_order' => 1,
        ]);
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login?manual=1');
        $response->assertStatus(200);
        $response->assertSee('Motion Portfolio Backoffice');
    }

    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function test_api_motion_portfolio_returns_complete_payload(): void
    {
        $response = $this->getJson('/api/motion/portfolio');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'profile' => ['name', 'roleTitle', 'email'],
            'projects',
            'skills',
            'softwareTools',
            '_auth' => ['authenticated', 'client_app', 'api_source'],
        ]);

        $this->assertEquals('Moch. Adam Athallahrich', $response->json('profile.name'));
        $this->assertCount(1, $response->json('projects'));
        $this->assertEquals('mango-hcm', $response->json('projects.0.project_key'));
    }

    public function test_api_motion_projects_returns_active_projects(): void
    {
        $response = $this->getJson('/api/motion/projects');
        $response->assertStatus(200);
        $this->assertCount(1, $response->json());
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $admin = User::create([
            'sub' => 'sub_admin_test_123',
            'name' => 'Admin Test',
            'email' => 'admin@iam-sso.local',
            'roles' => ['admin'],
            'permissions' => ['portfolio.read', 'portfolio.write', 'portfolio.publish'],
        ]);

        $response = $this->withSession([
            'iam_user' => [
                'sub' => $admin->sub,
                'name' => $admin->name,
                'email' => $admin->email,
                'roles' => $admin->roles,
                'permissions' => $admin->permissions,
            ],
            'iam_access_token' => 'dummy_token',
        ])->get('/');

        $response->assertStatus(200);
        $response->assertSee('Portofolio Motion Control Center');
    }

    public function test_admin_can_save_profile(): void
    {
        $admin = User::create([
            'sub' => 'sub_admin_test_123',
            'name' => 'Admin Test',
            'email' => 'admin@iam-sso.local',
            'roles' => ['admin'],
            'permissions' => ['portfolio.read', 'portfolio.write'],
        ]);

        $response = $this->withSession([
            'iam_user' => [
                'sub' => $admin->sub,
                'name' => $admin->name,
                'email' => $admin->email,
                'roles' => $admin->roles,
                'permissions' => $admin->permissions,
            ],
            'iam_access_token' => 'dummy_token',
        ])->postJson('/portfolio/profile', [
            'name' => 'Moch. Adam Athallahrich Updated',
            'roleTitle' => 'Lead Fullstack Architect',
            'email' => 'athallahrich@gmail.com',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $updated = MotionConfig::getValue('profile');
        $this->assertEquals('Moch. Adam Athallahrich Updated', $updated['name']);
        $this->assertEquals('Lead Fullstack Architect', $updated['roleTitle']);
    }

    public function test_admin_can_create_and_delete_project(): void
    {
        $admin = User::create([
            'sub' => 'sub_admin_test_123',
            'name' => 'Admin Test',
            'email' => 'admin@iam-sso.local',
            'roles' => ['admin'],
            'permissions' => ['portfolio.read', 'portfolio.write'],
        ]);

        // Create
        $response = $this->withSession([
            'iam_user' => [
                'sub' => $admin->sub,
                'name' => $admin->name,
                'email' => $admin->email,
                'roles' => $admin->roles,
                'permissions' => $admin->permissions,
            ],
            'iam_access_token' => 'dummy_token',
        ])->postJson('/portfolio/project', [
            'project_key' => 'new-project',
            'number' => '99',
            'title' => 'New Showcase Project',
            'cover_image' => '/img/cover.png',
            'is_active' => true,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('motion_projects', ['project_key' => 'new-project']);

        $created = MotionProject::where('project_key', 'new-project')->first();

        // Delete
        $delResponse = $this->withSession([
            'iam_user' => [
                'sub' => $admin->sub,
                'name' => $admin->name,
                'email' => $admin->email,
                'roles' => $admin->roles,
                'permissions' => $admin->permissions,
            ],
            'iam_access_token' => 'dummy_token',
        ])->postJson('/portfolio/project/delete/'.$created->id);

        $delResponse->assertStatus(200);
        $this->assertDatabaseMissing('motion_projects', ['project_key' => 'new-project']);
    }

    public function test_admin_can_upload_media_forwarded_to_iam(): void
    {
        \Illuminate\Support\Facades\Http::fake([
            '*/api/v1/storage/upload' => \Illuminate\Support\Facades\Http::response([
                'success' => true,
                'message' => 'File berhasil diunggah ke Core Storage.',
                'asset' => [
                    'id' => 99,
                    'url' => 'http://iam-sso-core.test:8888/storage/uploads/portfolio-admin/logos/20261101_sample.jpg',
                    'path' => '/storage/uploads/portfolio-admin/logos/20261101_sample.jpg',
                    'file_name' => '20261101_sample.jpg',
                    'original_name' => 'logo.jpg',
                    'mime_type' => 'image/jpeg',
                    'file_size' => 120000,
                    'formatted_size' => '117.2 KB',
                    'is_compressed' => false,
                ],
            ], 201),
        ]);

        $admin = User::create([
            'sub' => 'sub_admin_test_upload',
            'name' => 'Admin Test',
            'email' => 'admin@iam-sso.local',
            'roles' => ['admin'],
            'permissions' => ['portfolio.read', 'portfolio.write'],
        ]);

        $file = \Illuminate\Http\UploadedFile::fake()->image('logo.jpg', 150, 150);

        $response = $this->withSession([
            'iam_user' => [
                'sub' => $admin->sub,
                'name' => $admin->name,
                'email' => $admin->email,
                'roles' => $admin->roles,
                'permissions' => $admin->permissions,
            ],
            'iam_access_token' => 'dummy_token',
        ])->post('/portfolio/upload', [
            'file' => $file,
            'folder' => 'logos',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'asset' => [
                'url' => 'http://iam-sso-core.test:8888/storage/uploads/portfolio-admin/logos/20261101_sample.jpg',
            ],
        ]);
    }
}
