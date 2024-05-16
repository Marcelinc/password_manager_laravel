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
        "content" => "passwords",
        "login" => "User1",
        "isHmac" => true,
        "passwords" => [
            [
                "id" => 1,
                "password" => "123",
                "login" => "User",
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
        "content" => "security",
        "login" => "User1",
        "isHmac" => true,
        'passwordCount' => 2,
        "attempts" => [
            [
                "successful" => true,
                "device" => "Windows 10",
                "ip_address" => [
                    "address" => "127.0.0.1"
                ],
                "date" => "17-04-2024 12:30"
            ]
        ]
    ]);
});

Route::get('/dashboard/sharedPasswords',function(){
    return view('dashboard',[
        "content" => "sharedPasswords",
        "login" => "User1",
        "isHmac" => true,
        'passwordCount' => 2,
        "passwords" => [
            [
                "id" => 1,
                "valid" => true,
                "owner" => [
                    "id" => 1,
                    "login" => "User1"
                ],
                "password" => [
                    "id" => 3,
                    "value" => "password",
                    "login" => "User12",
                    "website" => [
                        "name" => "Youtube",
                    ]
                ]
            ]
        ]
    ]);
});