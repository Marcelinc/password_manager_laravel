@extends('layout')

@php
  $mode = 'Read';
  if(isset($passwords))
    $passwordCounter = count($passwords);
  else 
    $passwordCounter = $passwordCount;
@endphp

@section('content')
    <div class="content">
        <main>
            <section class="userDash">
                <div class="userInfo">
                    <h2>Hello {{$login}}</h2>
                    <p>Account type: <?= $isHmac ? 'HMAC' : 'SHA512'?></p>
                    <p>Your passwords: {{$passwordCounter}}</p>
                    <x-mode-selector :mode="$mode"/>
                  </div>
                  <div class="password-operations">
                    <a href="/dashboard/security" class="eventTag" title="Security">
                      <x-grommet-shield-security/>
                    </a>
                    <a href="/dashboard" class="eventTag" title="My passwords">
                      <x-zondicon-wallet />
                    </a>
                    <a href="/dashboard/sharedPasswords" class="eventTag" title="Sharing passwords">
                      <x-ri-user-shared-fill />
                    </a>
                    <a href="#" class='eventTag' title="Add new">
                      <x-ri-add-circle-fill />
                    </a>
                    <a href="#" class="{{($mode === 'Read' ? 'disabledBttn ' : '') . 'eventTag'}}" title="Change main password">
                      <x-ri-lock-password-line />
                    </a>
                  </div>
            </section>
        </main>
    </div>
@endsection