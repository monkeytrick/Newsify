<?php

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesViewedController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

// General routes
Route::controller(HomeController::class)->group(function (){

    Route::get('/', 'index');
    Route::get('/country/{name}/{code}', 'country');
    Route::get('/category/{category}', 'category');
    Route::get('/sources/{source}', 'sources');
    Route::get('/query/{query}', 'query');
    Route::get('/test', 'test');

});

// Logged in user routes
Route::middleware(['user'])->controller(UserController::class)->group(function () {

    Route::get('/dashboard/user', 'index');
    Route::get('/user/bookmarks', 'bookmarks');
    Route::post('/user/bookmark', 'addBookmark');
    Route::delete('/user/bookmark/delete/{articleId}/{bookmarkId}', 'deleteBookmark');

});

// Admin
Route::middleware(['admin'])->controller(AdminController::class)->group(function () {
    
    // Admin dashboard homepage
    Route::get('/dashboard/admin', 'index');
    
    // Data APIS for charts
    Route::get('/admin/data/articles', 'articles');
    Route::get('/admin/data/bookmarks', 'bookmarks');

});

// Add article to DB after being viewed.
Route::post('article-viewed', [ArticlesViewedController::class, 'store']);


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
