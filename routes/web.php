<?php

use App\Http\Controllers\PageBuilderController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AuthTenantMiddlware;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/eula', function () {
            return view('eula');
        });
    });
}

// Admin dashboard middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    AuthTenantMiddlware::class
])->group(function () {
    Route::prefix('dashboard')->group(function() {
        Route::get('/', function() {
            return view('dashboard');
        })->name('dashboard');

        // The following routes will serve the page builder UI
        Route::any('/pages/{id}/build', [PageBuilderController::class, "build"])->name('pagebuilder.build');
        Route::any('/pages/build', [PageBuilderController::class, "build"]);

        Route::controller(PageController::class)->group(function () {
            Route::get('/theme', 'index')->name('theme');
            Route::get('/page/create', 'create');
            Route::post('/page/create', 'store');
            Route::get('/page/{id}/edit', 'edit');
            Route::post('/page/{id}', 'update');
            Route::get('/page/{id}/duplicate', 'duplicate');
            Route::post('/page/{id}/duplicate', 'clone');
            Route::get('/page/{id}/delete', 'delete');
            Route::post('/page/{id}/delete', 'destroy');
        });
    });
});
