<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //Get all user's passwords
    //@METHOD GET 
    //@ROUTE /dashboard
    public function index(){
        if(auth()->check()){
            //User logged in
            $passwords = Password::addSelect(['website' => Website::select('name')
            ->whereColumn('id','passwords.website_id')])->where('user_id',auth()->user()->id)->get();
            //dd($passwords);

            $bearerToken = auth()->user()->tokens()->where('tokenable_id',auth()->user()->id)->first()->token;

            return view('dashboard',[
                "content" => "passwords",
                "passwords" => $passwords,
                "bearer_token" => $bearerToken
            ]);
        } else{
            //User not logged in
            return redirect('login');
        }
    }

    //Create new user password
    public function store(Request $request){
        $id_user = auth()->user()->id ?? 1;
        $formFields = $request->validate([
            'password' => ['required'],
            'web_address' => ['required','exists:websites,id'],
            'login' => ['string'],
            'description' => ['string','max:1048576']
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Check if form fields were submitted
        $formFields['login'] = $formFields['login'] ?? '';
        $formFields['description'] = $formFields['description'] ?? 'No description';

        //Create password
        $password = Password::create([
            'password' => $formFields['password'],
            'login' => $formFields['login'],
            'description' => $formFields['description'],
            'website_id' => $formFields['web_address'],
            'user_id' => $id_user
        ]);

        return $password;
        //return redirect('/dashboard')->with('responseMessage','New password has beed added');
    }
}
