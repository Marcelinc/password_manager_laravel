<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //Get all user's passwords
    public function index(){
        //$passwords = Password::where('user_id',1)->get();
        //try{
            $passwords = Password::addSelect(['website' => Website::select('name')
            ->whereColumn('id','passwords.website_id')])->where('user_id',10)->get();
            dd($passwords);
        //} catch(Exception $e){
        //    echo "Error: " . $e->getMessage;
        //}
        
        //if(count($passwords) > 0)
            //$result = $passwords;
        //else 
        //    $result = [];

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
            //"passwords" => $passwords
        ]);
    }
}
