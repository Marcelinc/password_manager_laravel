@extends('layout')

@section('content')
    @push('scripts')
        @php
        $response = session('responseMessage');
        @endphp
        <script src="{{ asset('js/login.js') }}" defer></script>
        <script>
            lockDateTime = @json(session('timeLock'));
        </script>
    @endpush


    <main class="formPage">
        <section class="form-container">
            <h1>Sign in</h1>
            <form method="POST" action="/authenticate" class="form" id="loginForm">
                @csrf
                <label class="formElem">
                    <p>Login</p>
                    <input type='text' name="username" value="{{old('username')}}" id="usernameField"/>
                </label>
                @error('username')
                    <p class="appMessage" id="usernameInvalid">{{$message}}</p>
                @enderror
                <label class="formElem">
                    <p>Password</p>
                    <input type='password' name="password" value="{{old('password')}}" id="passwordField"/>    
                </label>
                @error('password')
                    <p class="appMessage" id="passwordInvalid">{{$message}}</p>
                @enderror
                <label class="formElem">
                    <input type="submit" value="Log in" class="submit" id="submitLogin" onclick="updateTempLock"/>
                </label>
                @error('login')
                    <p class="appMessage" id="loginResponse">{{$message}}</p>
                @enderror
                <p class="appMessage" id="loginMessage"></p>
                @if(isset($response))
                    <p class="appMessage" id="redirectMessage">{{$response}}</p>
                @endif
            </form>
        </section>
    </main>
@endsection

