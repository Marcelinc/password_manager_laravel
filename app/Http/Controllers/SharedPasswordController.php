<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Password;
use Illuminate\Http\Request;
use App\Models\SharedPassword;

class SharedPasswordController extends Controller
{
    //Get all shared passwords
    public function index(){

        /*$sharedPasswords = SharedPassword::addSelect([
            'owner_login' => User::select('name')->whereColumn('id','shared_passwords.id_owner'),
            'password' => Password::select('password','login')->whereColumn('id','shared_passwords.id_password')])
        ->where('id_receiver',2)->get();*/
        //$sharedPasswords = SharedPassword::join('users','users.id', '=','shared_password.id_owner')
       // ->get();

       // dd($sharedPasswords);

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
