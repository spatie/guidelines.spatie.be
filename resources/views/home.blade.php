@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{ app('navigation')->menu() }}
    </div>
</div>
@endsection
