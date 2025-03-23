<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PageBuilderController;
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
    // Think about re-doing the following
    // This might still be necessary?
    // Route::get('/search', [ContentController::class, 'showSearch']);

    // Route::post('/search', [ContentController::class, 'search']);
    Route::get('/search', [ContentController::class, 'search']);
    
    // Route::post('/live_search', [ContentController::class, 'live_search']);
    Route::post('/live_search', function() {
        logger("ITS WORKING");
    });

    // This can probably go away...
    // Route::get('/{path}', [ContentController::class, 'renderPage']);

    // TODO: This hasn't been tested yet.
    Route::any('/page/{title}', [
        'uses' => 'App\Http\Controllers\WebsiteController@page',
    ])->where('title', '.*')->name('page.show');

    // This MUST remain at the bottom of the document.
    Route::any('{uri}', [
        'uses' => 'App\Http\Controllers\WebsiteController@uri',
        'as' => 'page',
    ])->where('uri', '.*');
});
