@component('layouts.app', [
    'title' => $title,
])
    <nav class="sidebar waves">
        <div class="sidebar__background"></div>
        <div class="sidebar__contents">
            <div class="sidebar__logo">
                <a href="https://spatie.be" target="spatie">
                    @include('svg.logo')
                </a>
            </div>

            <div class="sidebar__home">
                <a href="{{ url('/') }}">Home</a>
            </div>
            {{ app('navigation')->menu() }}

            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    {{ csrf_field() }}
                    <button type="submit" class="sidebar__auth" title="Log out">
                        👋
                    </button>
                </form>
            @endif
        </div>
    </nav>
    <main class="main">
        <div class="article">
            {{ $contents }}
        </div>
    </main>
@endcomponent
