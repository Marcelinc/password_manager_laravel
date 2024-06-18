<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Password;
use Illuminate\Http\Request;
use App\Models\SharedPassword;

class SharedPasswordController extends Controller
{
    //Get all shared passwords
    //@METHOD GET
    //@ROUTE /dashboard/sharedPasswords
    public function index(){
        if(auth()->check()){
            //User logged in
            $sharedPasswords = SharedPassword::join('users','users.id', '=','shared_passwords.id_owner')
            ->join('passwords','passwords.id', '=','shared_passwords.id_password')
            ->join('websites','websites.id', '=','passwords.website_id')
            ->where('id_receiver',2)->get(['shared_passwords.valid','shared_passwords.id_owner','users.username','shared_passwords.id_password','passwords.password','passwords.login','websites.name as website']);

            //dd($sharedPasswords);

            return view('dashboard',[
                "content" => "sharedPasswords",
                'passwordCount' => 2,
                "passwords" => $sharedPasswords
            ]);
        } else{
            //User not logged in
            return redirect('login');
        }
    }
}
