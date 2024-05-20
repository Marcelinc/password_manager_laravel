<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //Get all user's passwords
    public function index(){
        $passwords = Password::addSelect(['website' => Website::select('name')
        ->whereColumn('id','passwords.website_id')])->where('user_id',10)->get();
        //dd($passwords);
        return view('dashboard',[
            "content" => "passwords",
            "login" => "User1",
            "isHmac" => true,
            "passwords" => $passwords
        ]);
    }
}
