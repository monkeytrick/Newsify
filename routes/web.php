<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesViewedController;
use Illuminate\Support\Facades\Log;

Route::get('/trial', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::controller(HomeController::class)->group(function (){

    Route::get('/', 'index');
    Route::get('/country/{name}/{code}', 'country');
    Route::get('/category/{category}', 'category');
    Route::get('/sources/{source}', 'sources');
    Route::get('/query/{query}', 'query');
    Route::get('/test', 'test');

});

// Add article to DB after being viewed.
Route::post('article-viewed', [ArticlesViewedController::class, 'store']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
