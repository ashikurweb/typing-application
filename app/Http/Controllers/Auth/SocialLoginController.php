<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider ( $provider )
    {
        // return Socialite::driver($provider)->redirect();
        return Inertia::location(Socialite::driver($provider)->redirect());
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            
            $authUser = $this->oauthLogin($user);

            Auth::login($authUser, true);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return to_route('dashboard')->with('success', 'Logged in successfully!');
    }

    public function oauthLogin($user)
    {
        $user = User::firstOrCreate(
            [
                'name'  => $user->name ?: $user->nickname,
                'email' => $user->email,
            ],
            [
                'name'      => $user->name ?: $user->nickname,
                'email'     => $user->email,
                'password'  => Hash::make(md5(uniqid().now())),
                'email_verified_at' => now()
            ]
        );

        return $user;
    }
}
