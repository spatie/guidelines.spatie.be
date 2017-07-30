@component('layouts.app')
    <section class="home">
        <header class="home__header waves">
            <div class="home__header__inner">
                <div class="home__logo">
                    <a href="https://spatie.be" target="spatie">
                        @include('svg.logo')
                    </a>
                </div>
                <h1 class="home__title">
                    Guidelines
                </h1>
            </div>
        </header>
        <section class="home__introduction">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia excepturi explicabo mollitia ducimus ad maiores voluptatum distinctio et quidem! Molestias ullam autem repellat quia aut nemo porro ab eaque fuga.</p>
        </section>
        <nav class="home__nav">
            <div class="home__nav__inner">
                {{ app('navigation')->menu()->addClass('menu--home') }}
            </div>
        </nav>
        <footer class="home__credits">
            <a href="https://spatie.be" target="spatie">
                © spatie.be, Antwerp
            </a>
        </footer>
    </section>
@endcomponent
