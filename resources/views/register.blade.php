@extends('layout')

@section('content')
    <main class="formPage">
        <div class="form-container">
            <h1>Create an account</h1>
            <form method="POST" action="/create-user" class="form">
                @csrf
                <label class="formElem">
                    <p>Login</p>
                    <input type='text' name="username" value="{{old('username')}}"/>
                    
                </label>
                @error('username')
                    <p class="appMessage">{{$message}}</p>
                @enderror
                <label class="formElem">
                    <p>Password</p>
                    <input type='password' name="password" value="{{old('password')}}"/>
                </label>
                @error('password')
                    <p class="appMessage">{{$message}}</p>
                @enderror
                <div class="formRadio">
                    <label>
                        <input type="radio" name="accountType" value='sha512' id="sha512" <?=($type=='sha512' ? "checked" : old('accountType')=="sha512") ? "checked" : ""?>/>
                        SHA512
                    </label>
                    <label>
                        <input type="radio" name="accountType" value='hmac' id="hmac" <?=($type=='hmac' ? "checked" : old('accountType')=="hmac") ? "checked" : ""?>/>
                        HMAC
                    </label>
                </div>
                @error('accountType')
                        <p class="appMessage">{{$message}}</p>
                @enderror
                <div class="formElem">
                    <input type="submit" class="submit" value="Register"/>
                </div>
                <p class="appMessage"></p>
            </form>
        </div>
    </main>
@endsection