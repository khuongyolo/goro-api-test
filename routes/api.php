<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostAPIController;
use App\Http\Controllers\UsernameAPIController;

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

// Route::get('/index', [PostAPIController::class, 'index'])->name('api.index');
// Route::post('/addpost', [PostAPIController::class, 'addPost'])->name('api.addpost');


// POST index
Route::match(['get', 'post'], '/index', [PostAPIController::class, 'index'])->name('api.index');
// POST edit
Route::get('/edit/{id}', [PostAPIController::class, 'edit'])->name('api.edit');
// POST update
Route::post('/update', [PostAPIController::class, 'update'])->name('api.update');
// POST delete
Route::get('/delete/{id}', [PostAPIController::class, 'delete'])->name('api.delete');
// POST register
Route::match(['get', 'post'], '/register', [PostAPIController::class, 'register'])->name('api.register');
