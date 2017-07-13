@component('layouts.app', [
    'background' => true,
    'title' => 'Login',
])
    <div class="auth">
        <form class="auth__form" method="POST" action="{{ route('login') }}">
            <h1 class="auth__hello" title="Log In">🔑</h1>
            {{ csrf_field() }}
            <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
                class="auth__field"
                placeholder="E-mail"
            >
            <input
                type="password" 
                name="password" 
                required 
                class="auth__field"
                placeholder="Password"
            >
            <button type="submit" class="auth__button">
                Log In
            </button>
            @if($errors->has('email'))
                <div class="auth__error">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <div class="auth__back">
                <a href="{{ url('/') }}">Back home</a>
            </div>
        </form>
    </div>
@endcomponent
