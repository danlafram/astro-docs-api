<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PageBuilderController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AuthTenantMiddlware;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/eula', function () {
            return view('eula');
        });

        Route::get('/register/{cloudId}', [AuthenticationController::class, 'show']);
    });
}

// Admin dashboard middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    AuthTenantMiddlware::class,
])->group(function () {
    
    // The following routes will serve the page builder UI
    Route::any('/dashboard/pages/{id}/build', [PageBuilderController::class, "build"])->name('pagebuilder.build');
    Route::any('/dashboard/pages/build', [PageBuilderController::class, "build"]);


    Route::prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/domains', [DomainController::class, 'index'])->name('domains');

        Route::controller(PageController::class)->group(function () {
            Route::get('/theme', 'index')->name('theme');
            Route::get('/theme/{theme}/publish', 'publish')->name('publish_theme');
            Route::get('/page/create', 'create');
            Route::post('/page/create', 'store');
            Route::get('/page/{id}/edit', 'edit');
            Route::post('/page/{id}', 'update');
            Route::get('/page/{id}/duplicate', 'duplicate');
            Route::post('/page/{id}/duplicate', 'clone');
            Route::get('/page/{id}/delete', 'delete');
            Route::post('/page/{id}/delete', 'destroy');
            Route::get('/page/{id}/toggle', 'toggle');
        });
    });
});
