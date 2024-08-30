<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsernameAPIController;
use App\Http\Controllers\UsernameController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'welcome'])->name('welcome');


// Route::get('/username', [UsernameController::class, 'index'])->name('username');
// Route::post('/username', [UsernameController::class, 'username'])->name('username');

// POST index
Route::match(['get', 'post'], '/index', [PostController::class, 'index'])->name('index');
// POST edit
Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
// POST update
Route::post('/update', [PostController::class, 'update'])->name('update');
// POST delete
Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete');
// POST register
Route::match(['get', 'post'], '/register', [PostController::class, 'register'])->name('register');
// Route::get('/addpost', [PostController::class, 'addpostsIndex'])->name('addpostsindex');

// Route::post('/addpost', [PostController::class, 'addposts'])->name('addposts');



Route::fallback(function ($routes) {
    abort(404);
});

