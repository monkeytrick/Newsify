<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesViewedController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


Route::controller(HomeController::class)->group(function (){

    Route::get('/', 'index');
    Route::get('/country/{name}/{code}', 'country');
    Route::get('/category/{category}', 'category');
    Route::get('/sources/{source}', 'sources');
    Route::get('/query/{query}', 'query');
    Route::get('/test', 'test');

});

// When using properly - Add below to middleware or gate
Route::get('/dashboard/user', [UserController::class, 'index']);
Route::get('/user/bookmarks', [UserController::class, 'bookmarks']);
Route::post('/user/bookmark', [UserController::class, 'addBookmark']);
Route::delete('/user/bookmark/delete/{articleId}/{bookmarkId}', [UserController::class, 'deleteBookmark']);

// Add article to DB after being viewed.
Route::post('article-viewed', [ArticlesViewedController::class, 'store']);



// Re-write to use gate as middleware and group controllers
Route::get('/dashboard/admin', function(){
    
    if(Gate::denies('is-admin')) {
        return abort(403, 'You are not authorized to access this page.');
    }

    return Inertia::render('AdminTrial');

})->name('admin.dashboard');


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
