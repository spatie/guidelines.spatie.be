@component('layouts.app', [
    'title' => $title,
])
    <section class="sidebar waves">
        <nav class="sidebar__contents">
            <div class="sidebar__logo">
                <a href="https://spatie.be" target="spatie">
                    @include('svg.logo')
                </a>
            </div>
            <div class="sidebar__home">
                <a href="{{ url('/') }}">Home</a>
            </div>
            {{ app('navigation')->menu() }}
        </nav>
        <footer class="sidebar__footer">
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    {{ csrf_field() }}
                    <button type="submit" class="sidebar__auth" title="Log out">
                        👋
                    </button>
                </form>
            @endif
            <a href="https://spatie.be" target="spatie">
                © spatie.be, Antwerp
            </a>
        </footer>
    </section>
    <main class="main">
        <div class="article">
            {{ $contents }}
        </div>
    </main>
@endcomponent
