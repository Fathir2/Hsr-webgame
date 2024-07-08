<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebNewsController;
use App\Http\Controllers\WebTipsController;
use App\Http\Controllers\WebVideoController;

use Illuminate\Support\Facades\Route;


// Videos Route
 
Route::get('/videos', [WebVideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [WebVideoController::class, 'create'])->name('videos.create');
Route::post('/videos', [WebVideoController::class, 'store'])->name('videos.store');
Route::get('/videos/{video}/edit', [WebVideoController::class, 'edit'])->name('videos.edit');
Route::put('/videos/{video}', [WebVideoController::class, 'update'])->name('videos.update');
Route::delete('/videos/{id}', [WebVideoController::class, 'destroy'])->name('videos.destroy');


// News Route

Route::get('/news', [WebNewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [WebNewsController::class, 'create'])->name('news.create');
Route::post('/news', [WebNewsController::class, 'store'])->name('news.store');
Route::get('/news/{new}/edit', [WebNewsController::class, 'edit'])->name('news.edit');
Route::put('/news/{new}', [WebNewsController::class, 'update'])->name('news.update');
Route::delete('/news/{id}', [WebNewsController::class, 'destroy'])->name('news.destroy');


// Tips Route 

Route::get('/tips', [WebTipsController::class, 'index'])->name('tips.index');
Route::get('/tips/create', [WebTipsController::class, 'create'])->name('tips.create');
Route::post('/tips', [WebTipsController::class, 'store'])->name('tips.store');
Route::get('/tips/{tip}/edit', [WebTipsController::class, 'edit'])->name('tips.edit');
Route::put('/tips/{tip}', [WebTipsController::class, 'update'])->name('tips.update');
Route::delete('/tips/{id}', [WebTipsController::class, 'destroy'])->name('tips.destroy');


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
