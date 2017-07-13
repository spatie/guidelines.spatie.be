@component('layouts.app', [
    'title' => $title,
])
    <div class="layout">
        <div class="layout__sidebar">
            <nav class="sidebar">
                <div class="sidebar__background"></div>
                <div class="sidebar__contents">
                    <div class="sidebar__logo">
                        <a href="https://spatie.be" target="spatie">
                            @include('svg.logo')
                        </a>
                    </div>

                    {{ app('navigation')->menu() }}

                    @if(Auth::check())
                        <form method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="sidebar__auth">
                                Log Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="sidebar__auth">
                            Log In
                        </a>
                    @endif
                </div>
            </nav>
        </div>
        <div class="layout__main">
            <main class="main">
                <div class="article">
                    {{ $contents }}
                </div>
            </div>
        </main>
    </div>
@endcomponent
