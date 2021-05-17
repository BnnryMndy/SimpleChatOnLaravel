<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get('/messages', function () {
//     return view('messages');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/message', [App\Http\Controllers\HomeController::class, 'ajaxIndex']);

//in lesson practice
Route::get('/about', function(){
    return view('about');
});
Route::get('/message/from/{id}', function ($id){
    return App\Http\Controllers\HomeController::ajaxFromId($id);
});

Route::get('/message/add', function (Request $request){
    return App\Http\Controllers\HomeController::store($request);
});
// Route::resource('/messages', App\Http\Controllers\MessagesController, ['only' => ['index', 'store', 'show', 'destroy']]);
