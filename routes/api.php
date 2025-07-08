<?php

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\IndexingController;
use App\Http\Controllers\JobStatusController;
use App\Http\Controllers\QueryController;

// Sites
Route::get('site', [SiteController::class, 'show']);
Route::post('site', [SiteController::class, 'store']);

// Indexing
Route::post('initiateIndexing', [IndexingController::class, 'index_data']);
Route::post('reindex', [IndexingController::class, 'reindex_data']);
Route::post('indexPage', [IndexingController::class, 'index_page']);
Route::post('delete-page', [IndexingController::class, 'delete_page']);

// Queries
Route::get('query/{cloud_id}', [QueryController::class, 'index']);

// Pages
Route::post('page', [ContentController::class, 'store']);
Route::get('indexed_pages', [ContentController::class, 'indexed_pages']);
Route::patch('page/{id}/visible', [ContentController::class, 'toggle_visibility']);

// Jobs
Route::get('/jobs/status/{id}', [JobStatusController::class, 'get_job_status']);


// Emails
Route::post('email', function(Request $request){
    try {
        $first_name = $request->input('first-name');
        $last_name = $request->input('last-name');
        $email = $request->input('email');
        $question = $request->input('message');
        // TODO: Queue the message instead of inline
        Mail::to('dan@spoke.dev')->send(new TestMail($first_name, $last_name, $email, $question));

        // Return to success page.
        return view('feedback');
    } catch(\Exception $e){
        // Return to error page.
        return view('feedback');
    }
    
});
