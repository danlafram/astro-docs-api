<?php

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\IndexingController;

// Sites
Route::get('site/{cloud_id}', [SiteController::class, 'show']);
Route::post('site', [SiteController::class, 'store']);

// Indexing
Route::post('initiateIndexing', [IndexingController::class, 'indexData']);
// TODO Add a route for single page indexing (?) maybe...
Route::post('delete-page', [IndexingController::class, 'deletePage']);

// Pages
Route::post('page', [PageController::class, 'store']);
Route::patch('page/{id}/visible', [PageController::class, 'toggleVisibility']);

// Test emails

Route::post('email', function(Request $request){
    try {
        $first_name = $request->input('first-name');
        $last_name = $request->input('last-name');
        $email = $request->input('email');
        $question = $request->input('message');
        // TODO: Queue the message instead of inline
        Mail::to('dan.laframb@gmail.com')->send(new TestMail($first_name, $last_name, $email, $question));

        // Return to success page.
        return view('feedback')->with('success', true);
    } catch(\Exception $e){
        // Return to error page.
        return view('feedback')->with('success', false);
    }
    
});
