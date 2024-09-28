<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UsernameController;
use App\Http\Controllers\UsernameAPIController;

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
Route::prefix('/user')->name('user.')->group(function () {
    Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [LoginController::class, 'index'])->name('top');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/login/redirect', [LoginController::class, 'redirectToGoogle'])->name('login.redirect');
    Route::get('/login/callback', [LoginController::class, 'handleGoogleCallback'])->name('login.callback');










    Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('register');
    // Route::get('/verify', [LoginController::class, 'showVerifyOtp'])->name('showverifyotp');
    // Route::post('/verify', [LoginController::class, 'verifyOtp'])->name('verifyotp');
    Route::get('/register_success', [LoginController::class, 'register_success'])->name('register_success');
    Route::get('/verify/{verify_code}', [LoginController::class, 'verify'])->name('verify');

    Route::middleware(['auth'])->group(function () {
        Route::get('/homepage', [LoginController::class, 'homepage'])->name('homepage');
        Route::post('/change-avatar', [HomepageController::class, 'changeAvatar'])->name('changeAvatar');
    });
});


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


// database
Route::prefix('/database')->name('user.')->group(function () {
    Route::get('/', [DatabaseController::class, 'index'])->name('index');
    Route::get('/test', [DatabaseController::class, 'test'])->name('test');
});

// Webhook
Route::post('/webhook', [WebhookController::class, 'handleWebhook']);

Route::fallback(function ($routes) {
    abort(404);
});

