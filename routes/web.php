<?php

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [PageController::class, 'showSearch']);

Route::post('/search', [PageController::class, 'search']);

Route::get('/{path}', [PageController::class, 'renderPage']);
