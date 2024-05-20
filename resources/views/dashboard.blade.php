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
                    <h2>Hello {{auth()->user()->username}}</h2>
                    <p>Account type: <?= auth()->user()->isPasswordKeptAsHmac ? 'HMAC' : 'SHA512'?></p>
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

            @if($content === "passwords")
              <x-password-section :passwords="$passwords"/>
            @elseif($content === "security")
              <x-security-section :attempts="$attempts"/>
            @elseif($content === "sharedPasswords")
              <x-shared-password-section :passwords="$passwords"/>
            @endif
        </main>
    </div>
@endsection