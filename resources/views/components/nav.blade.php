@php
    $auth = false;
@endphp
<nav>
    @if($auth)
        <a href="/logout" id="logout">Logout</a>
    @else
        <a href="/">PasswordWallet</a>
        <div class="authLinks">
            <a href="#">Log in</a>
            <a href="/register">Register</a>
        </div>
    @endif
</nav>