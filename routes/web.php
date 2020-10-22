<?php

use App\Http\Controllers\HobbyController;
use App\Http\Controllers\hobbyTagController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Hobby;
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
    return view('start');
});

//Route::get('/hobby',[HobbyController::class,'index']);

Route::get('/info', function () {
    return view('info');
});

Route::resource('hobby', HobbyController::class);

Route::resource('tag',TagController::class);

Route::resource('user', UserController::class);

//Filter
Route::get('/hobby/tag/{tag_id}', [hobbyTagController::class,'getFilterHobby'] )->name('home');

// Attach and Detach
Route::get('/hobby/{hobby_id}/tag/{tag_id}/attach', [hobbyTagController::class, 'attachTag'])->middleware('auth');
Route::get('/hobby/{hobby_id}/tag/{tag_id}/detach', [hobbyTagController::class, 'detachTag'])->middleware('auth');

//Delete Image
Route::get('/delete-image/hobby/{hobby_id}',[hobbyController::class,'deleteImage']);

//Delete User

Route::get('/delete-image/user/{user_id}', [UserController::class, 'deleteImageUser']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
