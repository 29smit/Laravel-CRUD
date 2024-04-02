<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/users', [UserController::class,'index']);
Route::post('/users/store',[UserController::class,'store']);
Route::get('/users/{id}/edit', [UserController::class,'edit']);
Route::post('/users/{id}', [UserController::class,'update']);
Route::get('/users/delete/{id}', [UserController::class,'destroy']);
