<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard',function(){
    return view('dashboard',[
        "login" => "User1",
        "isHmac" => true,
        "passwords" => [
            [
                "id" => 1,
                "password" => "123",
                "website" => [
                    'id' => 1,
                    'name' => 'Youtube'
                ]
            ],[
                "id" => 2,
                "password" => "abc",
                "website" => [
                    'id' => 2,
                    'name' => 'Instagram'
                ] 
            ]
        ],
    ]);
});

Route::get('/dashboard/security',function(){
    return view('dashboard',[
        "login" => "User1",
        "isHmac" => true,
        'passwordCount' => 2
    ]);
});

Route::get('/dashboard/sharedPasswords',function(){
    return view('dashboard',[
        "login" => "User1",
        "isHmac" => true,
        'passwordCount' => 2
    ]);
});