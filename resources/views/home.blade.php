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
        <main class="home__meat">
            <section class="home__introduction">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia excepturi explicabo mollitia ducimus ad maiores voluptatum distinctio et quidem! Molestias ullam autem repellat quia aut nemo porro ab eaque fuga.</p>
            </section>
            <nav>
                {{ app('navigation')->menu()->addClass('menu--home') }}
            </nav>
            <footer class="home__credits">
                <a href="https://spatie.be" target="spatie">
                    © spatie.be, Antwerp
                </a>
            </footer>
        </main>
    </section>
@endcomponent
