<?php

use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
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

Route::get('/', Welcome::class);

Route::put('post/', [PostController::class, 'index'])->name('post.index');
Route::put('post/{id}/publish', [PostController::class, 'publish'])->name('post.publish');
Route::put('post/{id}/unpublish', [PostController::class, 'unpublish'])->name('post.unpublish');


// Route untuk mengelola postingan
// Route::middleware(['auth'])->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('post.index'); // Menampilkan daftar postingan
    Route::get('posts/create', [PostController::class, 'create'])->name('post.create'); // Menampilkan form untuk membuat postingan
    Route::post('posts', [PostController::class, 'store'])->name('post.store'); // Menyimpan postingan baru
    Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit'); // Menampilkan form untuk mengedit postingan
    Route::put('posts/{id}', [PostController::class, 'update'])->name('post.update'); // Memperbarui postingan
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('post.destroy'); // Menghapus postingan
    Route::put('posts/{id}/publish', [PostController::class, 'publish'])->name('post.publish'); // Mempublikasikan postingan
    Route::put('posts/{id}/unpublish', [PostController::class, 'unpublish'])->name('post.unpublish'); // Menghapus publikasi postingan
// });


Route::get('/confirmation-start', \App\Livewire\ConfirmationStart::class)->name('confirmation-start');
Route::get('/exam', \App\Livewire\Exam::class)->name('exam');
Route::get('/confirmation-finish', \App\Livewire\ConfirmationFinish::class)->name('confirmation-finish');

