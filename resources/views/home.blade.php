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
            <p class="-large">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec odio ultricies, accumsan ipsum non, consequat magna. In ut rutrum lectus.
            </p>
            <p>
                Praesent luctus justo eros, ut ultricies mauris iaculis ac. Vestibulum molestie odio sit amet euismod fermentum. Vivamus vel maximus risus, vel efficitur ligula. In rhoncus nulla velit, eget accumsan mi rutrum eu. Etiam at leo vitae nisl vehicula pharetra. 
            </p>
            <p>
                Vestibulum ultrices velit ut odio cursus, at imperdiet orci rutrum. Nunc eu lacus id nisl mollis sollicitudin. Praesent felis leo, ornare non est et, tincidunt dapibus augue. Sed metus metus, laoreet non porta eget, semper vitae odio.
            </p>
        </section>
        <nav class="home__index">
            <div class="home__index__inner">
                {{ app('navigation')->menu()->addClass('menu--home') }}
            </div>
            <footer class="home__index__footer">
                <a href="https://spatie.be" target="spatie">
                    © spatie.be, Antwerp
                </a>
            </footer>
        </nav>
    </section>
@endcomponent
