<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/blog', BlogController::class)->name('blog');
Route::get('/single/{single}', SingleController::class)->name('single');
Route::get('/posts/{post}', PostShowController::class)->name('posts.show');


Route::prefix('/admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('items', ItemController::class);
    Route::resource('posts', PostController::class)->except('show');
});
