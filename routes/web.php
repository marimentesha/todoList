<?php

use App\Http\Controllers\{HomeController, UserController};
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::get('/to/do', [HomeController::class, 'index'])->middleware('auth');
Route::post('/to/do', [HomeController::class, 'store'])->middleware('auth');

Route::get('/in/progress', [HomeController::class, 'index'])->middleware('auth');
Route::post('/in/progress', [HomeController::class, 'store'])->middleware('auth');

Route::get('/done', [HomeController::class, 'index'])->middleware('auth');
Route::post('/done', [HomeController::class, 'store'])->middleware('auth');

Route::get('/edit/{id}', [HomeController::class, 'index'])->middleware('auth');
Route::patch('/update/{id}', [HomeController::class, 'update'])->middleware('auth');

Route::delete('/destroy', [HomeController::class, 'destroy'])->middleware('auth');

Route::post('/move/{id}', [HomeController::class, 'move'])->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->middleware('guest');
