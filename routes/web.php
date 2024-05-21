<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\LoginAttemptController;
use App\Http\Controllers\SharedPasswordController;

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
    return view('welcome');
});

//Show register page
Route::get('/register', [UserController::class,'create']);

//Create a new user
Route::post('/create-user',[UserController::class,'store']);

//Log out user
Route::post('/logout',[UserController::class,'logout']);

//Show login page
Route::get('/login',[UserController::class,'login']);

Route::post('/authenticate',[UserController::class,'authenticate']);


Route::get('/dashboard',[PasswordController::class,'index']);

Route::get('/dashboard/security',[LoginAttemptController::class,'index']);

Route::get('/dashboard/sharedPasswords',[SharedPasswordController::class,'index']);