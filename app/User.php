<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function findOrCreate(SocialiteUser $socialiteUser): User
    {
        if (! $user = User::whereEmail($socialiteUser->getEmail())->first()) {
            $user = static::create([
                'email' => $socialiteUser->getEmail(),
                'name' => $socialiteUser->getName(),
                'password' => bcrypt(Str::random()),
            ]);
        }

        return $user;
    }
}
