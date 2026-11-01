<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motion_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_key', 100)->unique();
            $table->string('number', 10)->default('01');
            $table->string('title', 255);
            $table->string('subtitle', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('period', 100)->nullable();
            $table->enum('category', ['enterprise', 'personal'])->default('enterprise');
            $table->json('roles')->nullable();
            $table->string('cover_image', 500);
            $table->string('logo', 500)->nullable();
            $table->text('description')->nullable();
            $table->json('impact_highlights')->nullable();
            $table->json('tech_stack')->nullable();
            $table->json('team')->nullable();
            $table->string('live_url', 500)->nullable();
            $table->string('repo_url', 500)->nullable();
            $table->text('demo_credentials')->nullable();
            $table->json('gallery')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('motion_configs', function (Blueprint $table) {
            $table->id();
            $table->string('config_key', 100)->unique();
            $table->longText('config_value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motion_configs');
        Schema::dropIfExists('motion_projects');
    }
};
