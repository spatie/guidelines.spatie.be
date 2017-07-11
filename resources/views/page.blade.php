@component('layouts.app', [
    'title' => $title,
])
    <div class="container">
        <div class="row">
            {{ $contents }}
        </div>
    </div>
@endcomponent
