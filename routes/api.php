<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsernameController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/index', [PostController::class, 'index'])->name('index');
Route::post('/addpost', [PostController::class, 'addPost'])->name('addpost');


Route::get('/username', [UsernameController::class, 'index'])->name('username');
Route::post('/username', [UsernameController::class, 'username'])->name('username');
