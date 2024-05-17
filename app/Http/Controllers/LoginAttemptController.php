<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAttemptController extends Controller
{
    //Get all login attempts
    public function index(){
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
    }
}
