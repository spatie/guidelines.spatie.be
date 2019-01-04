@component('layouts.app', [
    'title' => 'Page not found',
])
    <div class="error error--404">
        <div class="error__inner">
            <h1 class="error__title">Page not found</h1>
            <p class="error__subtext">We don't have any guidelines for this, <br> looks like you're on your own from here.</p>
            <p class="error__subtext error__subtext--small"><a href="{{ url('/') }}">I'm scared, take me home</a></p>
        </div>
        <div class="error__credits">
            <a href="https://unsplash.com/photos/muxykzQtu1I">Image by Sweet Ice Cream Photography</a>
        </div>
    </div>
@endcomponent
