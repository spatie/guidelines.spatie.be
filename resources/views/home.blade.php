@component('layouts.app')
    <section class="home">
        <header class="home__header waves">
            <div class="home__header__inner">
                <div class="home__logo">
                    <a href="https://adaptivemedia.se">
                        <img src="/images/logotype.png">
                    </a>
                </div>
                <h1 class="home__title">
                    Guidelines
                </h1>
            </div>
        </header>
        <section class="home__introduction">
            <p class="-large">
                This site contains a set of guidelines we use to bring our
                projects to a good end. We decided to document our workflow
                because consistency is one of the most valuable traits of
                maintainable software.
            </p>
            <p>
                The contents of this site exist for ourselves—more importantly,
                our future selves—and for giving future collegues a reference to
                our way of doing things and their quirks. The guidelines cover
                workflow, code style, and other little things we consider
                worth documenting.
            </p>
            <p>
                All pages are hosted on
                <a href="https://github.com/adaptivemedia/guidelines.adaptivemedia.se">
                    GitHub
                </a>, so edits and improvements are welcome.
                Note that these are our own opinionated ideas, so we'll be
                finicky when it comes to substantial changes.
            </p>
        </section>
        <nav class="home__index">
            <div class="home__index__inner">
                {{ app('navigation')->menu()->addClass('menu--home') }}
            </div>
            <footer class="home__index__footer">
                <a href="https://adaptivemedia.se" target="spatie">
                    © adaptivemedia.se, Stockholm
                </a>
            </footer>
        </nav>
    </section>
@endcomponent
