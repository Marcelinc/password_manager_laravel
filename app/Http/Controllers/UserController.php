<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\IpAddress;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Create a new User form
    public function create(Request $request){
        if(auth()->check())
            return redirect('/dashboard');
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

    //Show login form
    public function login(){
        if(auth()->check())
            return redirect('/dashboard');
        return view('login');
    }

    //Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //login attempt data
        $clientAddressIP = $request->getClientIp();
        $clientDevice = $request->header('User-Agent');
        $userID = auth()->user()->id;
        $ipAddress = IpAddress::where('addressIP',$clientAddressIP)->where('id_user',$userID)->first();

        //Check if user was authenticated with ip address from request
        if(!$ipAddress){
            $ipAddress = IpAddress::create([
                'addressIP' => $clientAddressIP,
                'id_user' => $userID
            ]);
        }

        //Try to authenticate user
        if(auth()->attempt($formFields)){
            //User was authenticated

            //check if the account has not been permanently locked
            if(!$ipAddress->permanentLock){
                //check if the account has not been temporarily locked
                if($ipAddress->tempLock < date_create('now')){
                    //Generate a new session token
                    $request->session()->regenerate();

                    //Update login attempt
                    //$ipAddress

                } else{
                    return back()->withErrors(['login'=> 'Wait until next login attempt'])->onlyInput('username');
                }
            } else{
                return back()->withErrors(['login' => 'Your account has been locked because of too many unauthorized login attempts'])->onlyInput('username');
            }

            return redirect('/dashboard');
        } else{
            //User was not authenticated

            //Create login attempt
            LoginAttempt::create([
                'successful' => 1,
                'device' => $clientDevice,
                'id_user' => $userID,
                'id_address' => $ipAddress->id
            ]);
        }

        return back()->withErrors(['login' => 'Invalid credentials'])->onlyInput('username');
    }
}
