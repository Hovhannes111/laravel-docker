<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:user')->group(function () {
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index');
            Route::group(['prefix' => '{post}'], function () {
                Route::get('', [PostController::class, 'show'])->name('post.show');
                Route::post('/comment', [CommentController::class, 'create'])->name('comment.store');
                Route::put('/{comment}', [CommentController::class, 'update'])->name('comment.update');
                Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
            });

        });
    });

    Route::middleware('role:admin')->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::group(['prefix' => 'post'], function () {
                Route::get('/', [AdminPostController::class, 'index'])->name('admin.post.index');
                Route::post('/', [AdminPostController::class, 'store'])->name('admin.post.store');
                Route::get('create', [AdminPostController::class, 'create'])->name('admin.post.create');
                Route::group(['prefix' => '{post}'], function () {
                    Route::get('/', [AdminPostController::class, 'show'])->name('admin.post.show');
                    Route::put('/', [AdminPostController::class, 'update'])->name('admin.post.update');
                    Route::delete('/', [AdminPostController::class, 'destroy'])->name('admin.post.destroy');
                });
            });
            Route::delete('comment/{comment}', [AdminPostController::class, 'deleteComment'])->name('admin.comment.destroy');
        });
    });

});

require __DIR__ . '/auth.php';
