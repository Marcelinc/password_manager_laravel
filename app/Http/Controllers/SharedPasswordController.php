<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharedPasswordController extends Controller
{
    //Get all shared passwords
    public function index(){
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
    }
}
