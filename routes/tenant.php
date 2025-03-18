<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/', function () {
                return "Hello there admin";
                // logger("Here");
                // return view('admin');
            })->name('admin');

            // The following routes will serve the page builder UI
            // Route::any('/pages/{id}/build', [PageBuilderController::class, "build"])->name('pagebuilder.build');
            // Route::any('/pages/build', [PageBuilderController::class, "build"]);
        });
    });
    
    // Route::get('/', [PageController::class, 'showSearch']);
    Route::get('/', function(){
        return "Hello tenant";
    });
    
    Route::get('/search', [PageController::class, 'showSearch']);

    Route::post('/search', [PageController::class, 'search']);
    Route::post('/live_search', [PageController::class, 'live_search']);

    Route::get('/{path}', [PageController::class, 'renderPage']);
});
