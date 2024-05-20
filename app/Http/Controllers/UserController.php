<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Create a new User form
    public function create(Request $request){
        return view('register',[
            'type' => $request->type
        ]);
    }

    //Create a new User
    public function store(Request $request){
        $formFields = $request->validate([
            'username' => ['required', 'min:3', Rule::unique('users','username')],
            'password' => ['required', 'min:6'],
            'accountType' => ['required']
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create([
            'username' => $formFields['username'],
            'password' => $formFields['password'],
            'isPasswordKeptAsHmac' => $formFields['accountType'] === 'hmac' ? true : false,
            'salt' => fake()->unique()->regexify('[a-z0-9]{20}')
        ]);

        //Login
        auth()->login($user);

        return redirect('/dashboard')->with('message','Account has been created');
    }

    //Logout User
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message','Logged out');
    }
}
