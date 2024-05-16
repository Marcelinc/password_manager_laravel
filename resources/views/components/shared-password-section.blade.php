@props(['passwords'])

<section class="passwords">
    <h2>Sharing passwords</h2>
    <div class="shared-list">
        @unless(count($passwords) == 0)
            @foreach($passwords as $password)
                <x-shared-password :password="$password"/>
            @endforeach
        
        @else
            <p>You don't have any shared passwords</p>}
        @endunless
    </div>
</section>