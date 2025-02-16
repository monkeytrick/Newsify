<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::controller(HomeController::class)->group(function (){

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/country/{name}', [HomeController::class, 'country']);
    Route::get('/category/{category}', [HomeController::class, 'category']);
    Route::get('/sources/{source}', [HomeController::class, 'sources']);
    Route::get('/query/{query}', [HomeController::class, 'query']);

});


Route::get('/', [HomeController::class, 'index']);

Route::get('/query', [HomeController::class, 'query']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
