<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/




Auth::routes();


Route::get('/', [HomeController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/articles/add', [ArticleController::class, 'add'])->name('article.add');
Route::post('/articles/create', [ArticleController::class, 'create'])->name('article.create');
Route::get('/articles/detail/{id}', [ArticleController::class, 'detail'] )->name('article.detail');
Route::get('/articles/delete/{id}', [ArticleController::class, 'delete'])->name('article.destroy');

Route::post('/comments/create', [CommentController::class, 'create'])->name('comment.create');
Route::get('/comments/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
