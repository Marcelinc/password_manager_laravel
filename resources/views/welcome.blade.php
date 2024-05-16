@extends('layout')

@section('content')
    <div class="content-land landing">
        <main>
            <section class="appDescript">
                <h1>Save all your passwords in one place</h1>
                <div class="appDescript-box">
                  <h3>Safety First</h3>
                  <p>All passwords are encrypted and the only way to decrypt is to give your main account password</p>
                </div>
                <div class="appDescript-box">
                  <h3>Password Sharing</h3>
                  <p>With encrypted sharing options and granular access controls, you can confidently share passwords while maintaining utmost security and control over sensitive information.</p>
                </div>
                <div class="appDescript-box">
                  <h3>Account protection</h3>
                  <p>Choose between two encryption account types: SHA512 and HMAC. </p>
                </div>
              </section>
              <section class="accountType">
                <h2>Create account</h2>
                <div class="typeSelect">
                  <a href="/register?type=sha512" class="type sha"><p>SHA512</p></a>
                  <a href="/register?type=hmac" class="type hmac"><p>HMAC</p></a>
                </div> 
              </section>
        </main>
    </div>
@endsection