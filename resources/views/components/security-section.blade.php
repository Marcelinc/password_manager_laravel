@props(['attempts'])

<section class="passwords">
    <h2>Login attempts</h2>
    <div class="attempt-list">
        @unless(count($attempts) == 0)
            @foreach($attempts as $attempt)
                <x-attempt-details :attempt="$attempt"/>
            @endforeach
        @else
            <p>There are no login attempts yet</p>
        @endunless
    </div>
</section>