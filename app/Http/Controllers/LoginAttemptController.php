<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;

class LoginAttemptController extends Controller
{
    //Get all login attempts
    public function index(){
        $loginAttempts = LoginAttempt::addSelect(['ip_address' => IpAddress::select('addressIP')
            ->whereColumn('id','login_attempts.id_address')])->where('id_user',1)->get();
        
        //dd($loginAttempts);
 
        return view('dashboard',[
            "content" => "security",
            "login" => "User1",
            "isHmac" => true,
            'passwordCount' => 2,
            'attempts' => $loginAttempts
        ]);
    }
}
