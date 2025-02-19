<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesViewed;

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
    Route::get('/country/{name}', 'country');
    Route::get('/category/{category}', 'category');
    Route::get('/sources/{source}', 'sources');
    Route::get('/query/{query}', 'query');

});

// Add article to DB after being viewed.
Route::controller(ArticlesViewed::class)->group(function(){

    Route::post('/article-exists', 'exists');


});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
