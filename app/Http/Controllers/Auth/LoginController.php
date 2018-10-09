<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->scopes(['email'])
            ->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        abort_unless(ends_with($user->getEmail(), '@wilbergroup.com'), 403);

        $authenticatableUser = User::findOrCreate($user);

        auth()->login($authenticatableUser, true);

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
