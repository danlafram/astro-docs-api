<?php

use App\Http\Controllers\PageBuilderController;
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
    Route::get('/dashboard', function () {
        logger("Current tenant: " . tenant()->id);
        return view('dashboard');
    })->name('dashboard');
});
