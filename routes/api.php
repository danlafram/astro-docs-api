<?php

use App\Http\Controllers\IndexingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('site/{cloudId}', [SiteController::class, 'show']);

Route::post('site', [SiteController::class, 'store']);

Route::post('initiateIndexing', [IndexingController::class, 'indexData']);

Route::post('page', [PageController::class, 'store']);

Route::post('delete-page', [IndexingController::class, 'deletePage']);
