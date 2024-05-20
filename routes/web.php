<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('/register', function (Request $request) {
    return view('register',[
        'type' => $request->type
    ]);
});

Route::get('/login',function (){
    return view('login');
});

Route::get('/dashboard',[PasswordController::class,'index']);

Route::get('/dashboard/security',[LoginAttemptController::class,'index']);

Route::get('/dashboard/sharedPasswords',[SharedPasswordController::class,'index']);