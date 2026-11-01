<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/auth/login', [AuthController::class, 'redirect'])->name('auth.login');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Rute Portfolio Admin Backoffice (Diproteksi permission: portfolio.read)
Route::middleware('sso:portfolio.read')->group(function () {
    Route::get('/', [PortfolioAdminController::class, 'index'])->name('admin.dashboard');

    Route::post('/portfolio/profile', [PortfolioAdminController::class, 'saveProfile'])->name('admin.portfolio.profile');
    Route::post('/portfolio/project', [PortfolioAdminController::class, 'saveProject'])->name('admin.portfolio.project');
    Route::post('/portfolio/project/delete/{id}', [PortfolioAdminController::class, 'deleteProject'])->name('admin.portfolio.project.delete');
    Route::post('/portfolio/skills', [PortfolioAdminController::class, 'saveSkills'])->name('admin.portfolio.skills');
    Route::post('/portfolio/tools', [PortfolioAdminController::class, 'saveTools'])->name('admin.portfolio.tools');
    Route::post('/portfolio/experiences', [PortfolioAdminController::class, 'saveExperiences'])->name('admin.portfolio.experiences');
    Route::post('/portfolio/url', [PortfolioAdminController::class, 'savePortfolioUrl'])->name('admin.portfolio.url');
    Route::post('/portfolio/upload', [PortfolioAdminController::class, 'uploadMedia'])->name('admin.portfolio.upload');
});
