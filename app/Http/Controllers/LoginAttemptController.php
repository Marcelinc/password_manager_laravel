<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use App\Models\LoginAttempt;

class LoginAttemptController extends Controller
{
    //Get all login attempts
    //@METHOD GET
    //@ROUTE /dashboard/security
    public function index(){
        if(auth()->check()){
            //User logged in
            $loginAttempts = LoginAttempt::addSelect(['ip_address' => IpAddress::select('addressIP')
            ->whereColumn('id','login_attempts.id_address')])->where('id_user',auth()->user()->id)->
            orderBy('created_at','desc')->get();
        
            //dd($loginAttempts);

            $bearerToken = auth()->user()->tokens()->where('tokenable_id',auth()->user()->id)->first()->token;
    
            return view('dashboard',[
                "content" => "security",
                'passwordCount' => 2,
                'attempts' => $loginAttempts,
                "bearer_token" => $bearerToken
            ]);
        } else{
            //User not logged in
            return redirect('login');
        }    
    }
}
