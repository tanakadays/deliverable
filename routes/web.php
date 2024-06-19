<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [PostController::class, 'index']);

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'delete']);
    
    
    Route::get('/category_titles', [CategoryController::class, 'titlelist']);
    Route::get('/category_genres', [CategoryController::class, 'genrelist']);
    Route::get('/category_areas', [CategoryController::class, 'arealist']);
    Route::get('/category_titles/{category_title}', [CategoryController::class,'titleindex']);
    Route::get('/category_genres/{category_genre}', [CategoryController::class,'genreindex']);
    Route::get('/category_areas/{category_area}', [CategoryController::class,'areaindex']);
    
    Route::get('/search', [PostController::class, 'search']);
    Route::get('/like/{id}', [PostController::class, 'like']);
    Route::get('/unlike/{id}', [PostController::class, 'unlike']);
    Route::get('/mypage', [PostController::class, 'mypage']);
    
    Route::get('/geocode', [PostController::class, 'geocode']);
});


Route::get('/dashboard', function () {
    return redirect("/");
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
