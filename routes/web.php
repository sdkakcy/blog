<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\CategoryController as PanelCategoryController;
use App\Http\Controllers\Panel\HomeController as PanelHomeController;
use App\Http\Controllers\Panel\PostController as PanelPostController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\PostController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('post/{post:slug}', [PostController::class, 'show'])->name('post');
Route::get('category/{category:slug}', [CategoryController::class, 'show'])->name('category');

Route::group(['middleware' => ['auth'], 'prefix' => 'panel', 'as' => 'panel.'], function () {
    Route::get('/', [PanelHomeController::class, 'index'])->name('index');

    Route::resource('posts', PanelPostController::class);
    Route::resource('categories', PanelCategoryController::class);
    Route::resource('users', UserController::class);
});
