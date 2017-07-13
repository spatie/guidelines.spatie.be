@component('layouts.app')
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div>
            <label for="email">E-Mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            {{ $errors->first('email') }}
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            {{ $errors->first('password') }}
        </div>
        <div>
            <button type="submit">
                Login
            </button>
        </div>
    </form>
@endcomponent
