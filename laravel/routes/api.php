<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ResenasController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('files', FileController::class);
Route::post('files/{file}', [FileController::class, 'update_post']);

Route::post('/register', [TokenController::class, 'register']);
Route::post('/login', [TokenController::class, 'login']);
Route::post('/logout', [TokenController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/user', [TokenController::class, 'user'])->middleware(['auth:sanctum']);

Route::apiResource('places', PlaceController::class);

Route::post('/places/{place}/favorites', [PlaceController::class,'favorite']);
Route::delete('/places/{place}/favorites', [PlaceController::class,'unfavorite']);

//Route::post('places/{place}', [PlaceController::class,'update']);
Route::apiResource('post', PostController::class);
Route::post('/post/{post}/likes',[PostController::class, 'addlikes']);
Route::delete('/post/{post}/likes',[PostController::class, 'unlikes']);

Route::apiResource('comentarios', ComentariosController::class);
Route::apiResource('places.resenas', ResenasController::class);

