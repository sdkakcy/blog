<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\HomeController as PanelHomeController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\UserController;
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

Route::group(['middleware' => ['auth'], 'prefix' => 'panel', 'as' => 'panel.'], function () {
    Route::get('/', [PanelHomeController::class, 'index'])->name('index');

    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
});
