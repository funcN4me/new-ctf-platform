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
    Route::get('/task/show/{task}', [App\Http\Controllers\TaskController::class, 'get'])->name('tasks.modal.show');
    Route::post('/task/submit/{task}', [App\Http\Controllers\TaskController::class, 'checkFlag'])->name('tasks.submit');
    Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
    Route::post('/task/edit/{task}', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
    Route::get('/task/edit/{task}', [App\Http\Controllers\TaskController::class, 'editShow'])->name('tasks.edit.show');
    Route::get('/task/file/delete/{file}', [App\Http\Controllers\TaskController::class, 'deleteFile'])->name('tasks.file.delete');
    Route::get('/task/delete/{task}', [App\Http\Controllers\TaskController::class, 'deleteShow'])->name('tasks.delete.show');
    Route::post('/task/delete/{task}', [App\Http\Controllers\TaskController::class, 'delete'])->name('tasks.delete');

    Route::get('/users', [App\Http\Controllers\UsersController::class, 'list'])->name('users.list')->middleware('is_admin');
    Route::post('/users/store', [App\Http\Controllers\UsersController::class, 'store'])->name('users.store')->middleware('is_admin');
    Route::get('/users/{user}', [App\Http\Controllers\UsersController::class, 'profile'])->name('users.profile');
    Route::put('/users/{user}', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    Route::get('/users/{user}/change-status', [App\Http\Controllers\UsersController::class, 'changeUserStatus'])->name('users.status.change')->middleware('is_admin');
    Route::post('/users/{user}/change-avatar', [App\Http\Controllers\UsersController::class, 'changeAvatar'])->name('users.avatar.change');
    Route::get('/users/{user}/avatar/delete', [App\Http\Controllers\UsersController::class, 'deleteAvatar'])->name('users.avatar.delete');

    Route::get('/resources', [App\Http\Controllers\ResourcesController::class, 'list'])->name('resources.show');
    Route::get('/resources/resource/{resource}', [App\Http\Controllers\ResourcesController::class, 'show'])->name('resources.resource.show');
    Route::get('/resources/resource/edit/{resource}', [App\Http\Controllers\ResourcesController::class, 'showEdit'])->name('resources.resource.edit');
    Route::post('/resources/resource/edit/{resource}', [App\Http\Controllers\ResourcesController::class, 'edit'])->name('resources.resource.edit.submit');
    Route::get('/resources/resource/mark-as-read/{resource}', [App\Http\Controllers\ResourcesController::class, 'markAsRead'])->name('resources.resource.mark_as_read');
});
