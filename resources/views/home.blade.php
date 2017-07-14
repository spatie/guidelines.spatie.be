@component('layouts.app', [
    'background' => true,
])
    <section class="home">
        <header>
            <div class="home__logo">
                <a href="https://spatie.be" target="spatie">
                    @include('svg.logo')
                </a>
            </div>
            <h1 class="home__title">
                Guidelines
            </h1>
        </header>
        <nav>
            {{ app('navigation')->menu()->addClass('menu--home') }}
        </nav>
        <footer class="home__credits">
            <a href="https://spatie.be" target="spatie">
                © spatie.be, Antwerp
            </a>
        </footer>
    </section>
@endcomponent
