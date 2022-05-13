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

Route::get('/', [\App\Http\Controllers\AlbumController::class,'index']);



Route::resource('/albums',\App\Http\Controllers\AlbumController::class)->except('update');
Route::post('/albums/update/{id}',[\App\Http\Controllers\AlbumController::class,'update'])->name('albums.update');
Route::get('/albums/{id}/transfer',[\App\Http\Controllers\AlbumController::class,'transfer'])->name('albums.transfer');
Route::post('/albums/{id}/change',[\App\Http\Controllers\AlbumController::class,'change'])->name('albums.change');

Route::resource('/photos',\App\Http\Controllers\PhotoController::class)->except('create');
Route::get('/photos/create/{id}',[\App\Http\Controllers\PhotoController::class,'create'])->name('photos.create');


