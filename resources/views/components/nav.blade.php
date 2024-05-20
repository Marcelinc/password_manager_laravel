<nav>
    @auth
        <div id="logout">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" id="logout-button">Logout</button>
            </form>
        </div>
    @else
        <a href="/">PasswordWallet</a>
        <div class="authLinks">
            <a href="/login">Log in</a>
            <a href="/register">Register</a>
        </div>
    @endauth
</nav>