<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //Get all user's passwords
    public function index(){
        if(auth()->check()){
            //User logged in
            $passwords = Password::addSelect(['website' => Website::select('name')
            ->whereColumn('id','passwords.website_id')])->where('user_id',auth()->user()->id)->get();
            //dd($passwords);
            return view('dashboard',[
                "content" => "passwords",
                "passwords" => $passwords
            ]);
        } else{
            //User not logged in
            return redirect('login');
        }
    }
}
