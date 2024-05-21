@extends('layout')

@section('content')
    <main class="formPage">
        <section class="form-container">
            <h2>Sign in</h2>
            <form method="POST" action="/authenticate" class="form">
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
                <label class="formElem">
                    <input type="submit" value="Log in" class="submit"/>
                </label>
                <p class="appMessage"></p>
            </form>
        </section>
    </main>
@endsection