@extends('layout')

@section('content')
    <main class="formPage">
        <div class="form-container">
            <h1>Create an account</h1>
            <form class="form">
                <label class="formElem">
                    <p>Login</p>
                    <input type='text' name="login"/>
                </label>
                <label class="formElem">
                    <p>Password</p>
                    <input type='password' name="password"/>    
                </label>
                <div class="formRadio">
                    <label>
                        <input type="radio" name="accountType" value='sha512' id="sha512" <?=$type=='sha512' ? "checked" : ""?>/>
                        SHA512
                    </label>
                    <label>
                        <input type="radio" name="accountType" value='hmac' id="hmac" <?=$type=='hmac' ? "checked" : ""?>/>
                        HMAC
                    </label>
                </div>
                <div class="formElem">
                    <input type="submit" class="submit" value="Register"/>
                </div>
                <p class="appMessage"></p>
            </form>
        </div>
    </main>
@endsection