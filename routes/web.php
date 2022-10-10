<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::match(['POST', 'GET'],'/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');

    Route::get('/users', [App\Http\Controllers\UsersController::class, 'list'])->name('users.list');
    Route::get('/users/{user}', [App\Http\Controllers\UsersController::class, 'profile'])->name('users.profile');
    Route::delete('/users/{user}/delete', [App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete');
});
