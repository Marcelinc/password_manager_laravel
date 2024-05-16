@props(['passwords'])

<section class="passwords">
    <h2>My passwords</h2>
    <div class="password-list">
        @unless(count($passwords) == 0)
            @foreach($passwords as $password)
                <x-password :password="$password"/> 
            @endforeach
        @else
            <p>You have no saved passwords</p>
        @endunless
    </div> 
</section> 