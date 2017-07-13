@component('layouts.app', [
    'background' => true,
])
    <div class="container">
        <div class="row">
            {{ app('navigation')->menu()->addClass('menu--home') }}
        </div>
    </div>
@endcomponent
