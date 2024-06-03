<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\IpAddress;
use App\Models\LoginAttempt;
use Carbon\Carbon;
use DateInterval;
use DateTimeZone;
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
        $clientAddressIP = $request->getClientIp();
        $userID = auth()->user()->id;

        //Remove 1 from number of logged in instances count
        $ipAddress = IpAddress::where('addressIP',$clientAddressIP)->where('id_user',$userID)->first();
        $ipAddress->decrement('okLoginNum');

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
        $user = User::where('username',$request->only('username'))->first();
        if($user)
            $userID = $user->id;
        else
            return back()->withErrors(['login' => 'Invalid credentials'])->onlyInput('username');
        $ipAddress = IpAddress::where('addressIP',$clientAddressIP)->where('id_user',$userID)->first();

        //Check if user was authenticated with ip address from request
        if(!$ipAddress){
            $ipAddress = IpAddress::create([
                'addressIP' => $clientAddressIP,
                'id_user' => $userID
            ]);
        }

        //check if the account has not been permanently locked
        if(!$ipAddress->permanentLock){
            $tempLockDateTime = Carbon::create($ipAddress->tempLock,'Europe/Warsaw');
            $actualDateTime = Carbon::now('Europe/Warsaw');
            //dd($tempLockDateTime);
            //check if the account has not been temporarily locked
            if($tempLockDateTime->lt($actualDateTime)){
                //Try to authenticate user
                if(auth()->attempt($formFields)){
                    //User was authenticated

                    //Generate a new session token
                    $request->session()->regenerate();

                    //Update login attempt
                    $ipAddress->increment('okLoginNum');
                    $ipAddress->lastBadLoginNum = 0;
                    $ipAddress->tempLock = date_create('now');
                    $ipAddress->save();
                    
                    //Create login attempt
                    LoginAttempt::create([
                        'successful' => 1,
                        'device' => $clientDevice,
                        'id_user' => $userID,
                        'id_address' => $ipAddress->id
                    ]);

                    return redirect('/dashboard');

                } else{
                    //User was not authenticated
        
                    //Update of the attempt count status
                    $ipAddress->increment('lastBadLoginNum');
                    $ipAddress->increment('badLoginNum');
        
                    //Update temporary lock
                    if($ipAddress->lastBadLoginNum === 2){
                        $ipAddress->tempLock = date_create('now',new DateTimeZone('Europe/Warsaw'))->add(new DateInterval('PT15S'));
                        $ipAddress->save();
                    }
                    if($ipAddress->lastBadLoginNum === 3){
                        $ipAddress->tempLock = date_create('now',new DateTimeZone('Europe/Warsaw'))->add(new DateInterval('PT30S'));
                        $ipAddress->save();
                    }
                    if($ipAddress->lastBadLoginNum === 4){
                        $ipAddress->tempLock = date_create('now',new DateTimeZone('Europe/Warsaw'))->add(new DateInterval('PT2M'));
                        $ipAddress->save();
                    }
                    if($ipAddress->lastBadLoginNum > 4){
                        $ipAddress->permanentLock = 1;
                        $ipAddress->save();
                    }
        
                    //Create login attempt
                    LoginAttempt::create([
                        'successful' => 0,
                        'device' => $clientDevice,
                        'id_user' => $userID,
                        'id_address' => $ipAddress->id
                    ]);

                    return back()->withErrors(['login' => 'Invalid credentials'])->onlyInput('username');
                }
            } else{
                return back()->withErrors(['login'=> 'Wait ' . $tempLockDateTime->diffInSeconds($actualDateTime) . ' seconds until next login attempt'])->onlyInput('username')->with('timeLock',$tempLockDateTime->format('Y-m-d H:i:s'));
            }
        } else{
            return back()->withErrors(['login' => 'Your account has been locked because of too many unauthorized login attempts'])->onlyInput('username');
        }
    } 
}
