<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthenticatedSessionController::class, 'returnHome']);

Route::get('/dashboard', [AuthenticatedSessionController::class, 'showDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts', [AuthenticatedSessionController::class, 'showPosts'])->middleware(['auth', 'verified'])->name('posts');
Route::get('/new_post', [AuthenticatedSessionController::class, 'showNewPost'])->middleware(['auth', 'verified'])->name('new_post');
Route::get('/posts/{post_id}', [AuthenticatedSessionController::class, 'showSinglePost'])->middleware(['auth', 'verified'])->name('single_post');

Route::get('/search', [AuthenticatedSessionController::class, 'showSearch'])->middleware(['auth', 'verified'])->name('search');

require __DIR__.'/auth.php';
