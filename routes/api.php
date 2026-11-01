<?php

use App\Http\Controllers\Api\MotionApiController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

// Headless Motion Portfolio Endpoints (Consumable by Nuxt 3 Client)
Route::prefix('motion')->group(function () {
    Route::get('/portfolio', [MotionApiController::class, 'portfolio'])->name('api.motion.portfolio');
    Route::get('/projects', [MotionApiController::class, 'projects'])->name('api.motion.projects');
    Route::post('/project/save', [MotionApiController::class, 'saveProject'])->name('api.motion.project.save');
    Route::post('/config/save', [MotionApiController::class, 'saveConfig'])->name('api.motion.config.save');
});

// Outbox / Webhook receiver from IAM-SSO-CORE
Route::post('/webhooks/iam', [WebhookController::class, 'handle'])->name('api.webhooks.iam');
