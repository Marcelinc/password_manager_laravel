@extends('layout')

@section('content')
    <main class="formPage">
        <section class="form-container">
            <h2>Sign in</h2>
            <form class="form">
                <label class="formElem">
                    <p>Login</p>
                    <input type='text' name="login"/>
                </label>
                <label class="formElem">
                    <p>Password</p>
                    <input type='password' name="password"/>    
                </label>
                <label class="formElem">
                    <input type="submit" value="Log in" class="submit"/>
                </label>
                <p class="appMessage"></p>
            </form>
        </section>
    </main>
@endsection