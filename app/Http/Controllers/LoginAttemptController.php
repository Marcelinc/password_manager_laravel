<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use App\Models\LoginAttempt;

class LoginAttemptController extends Controller
{
    //Get all login attempts
    public function index(){
        if(auth()->check()){
            //User logged in
            $loginAttempts = LoginAttempt::addSelect(['ip_address' => IpAddress::select('addressIP')
            ->whereColumn('id','login_attempts.id_address')])->where('id_user',auth()->user()->id)->get();
        
            //dd($loginAttempts);
    
            return view('dashboard',[
                "content" => "security",
                'passwordCount' => 2,
                'attempts' => $loginAttempts
            ]);
        } else{
            //User not logged in
            return redirect('login');
        }    
    }
}
