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
| Here are all routes that are required to be authenticated by the active tenant.
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/search', [ContentController::class, 'search']);
    
    Route::post('/live_search', [ContentController::class, 'live_search']);
    
    Route::any('/page/{title}', [
        'uses' => 'App\Http\Controllers\WebsiteController@page',
    ])->where('title', '.*')->name('page.show');

    // This MUST remain at the bottom of the document.
    Route::any('{uri}', [
        'uses' => 'App\Http\Controllers\WebsiteController@uri',
        'as' => 'page',
    ])->where('uri', '.*');
});
