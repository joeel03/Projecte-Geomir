<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ResenasController;


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

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
});

Auth::routes();
require __DIR__.'/email-verify.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('mail/test', [MailController::class, 'test']);


/////////////////////
Route::resource('files', FileController::class)
->middleware(['auth', 'permission:files']);

Route::resource('posts', PostController::class)
   ->middleware(['auth', 'permission:posts']);
/*   
Route::resource('likes', LikesController::class)
    ->middleware(['auth']);
*/
Route::resource('places', PlaceController::class)
->middleware(['auth', 'permission:places']);

Route::resource('resenas', ResenasController::class)
->middleware(['auth']);

Route::get('/language/{locale}', [App\Http\Controllers\LanguageController::class, 'language']);

Route::post('/places/{place}/favorites', [App\Http\Controllers\PlaceController::class, 'favorite'])->name('places.favorite');
Route::delete('/places/{place}/favorites', [App\Http\Controllers\PlaceController::class, 'unfavorite'])->name('places.unfavorite');


Route::post('/posts/{post}/likes',[App\Http\Controllers\PostController::class, 'addlikes'])->name('posts.likes');
Route::delete('/posts/{post}/likes',[App\Http\Controllers\PostController::class, 'unlikes'])->name('posts.unlikes');



