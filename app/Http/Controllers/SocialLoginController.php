<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;
class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {   
        try {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();
       
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make('12345678'),
            ]);
            $customerRole = Role::findByName('Customer');
            if ($customerRole) {
                $user->assignRole('Customer');
            }
        }

        Auth::login($user, true);
        return redirect()->route('home');

        }catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::where('facebook_id', $facebookUser->id)->orWhere('email', $googleUser->email)->first();

        if (!$user) {
            // Create a new user if not exists
            $user = User::create([
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' => $facebookUser->id,
                'password' => Hash::make('12345678'),
            ]);
            $customerRole = Role::findByName('Customer');
            if ($customerRole) {
                $user->assignRole('Customer');
            }
        }

        Auth::login($user, true);
        return redirect()->route('home');
    }
}
