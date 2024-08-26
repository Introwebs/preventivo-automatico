<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\CommonHelper;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request) {

        // Authenticate with Google
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', '=', $googleUser->getEmail())->first();
        if (!$user) {
            $newUserpassword = CommonHelper::generateRandomPassword(8);
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make($newUserpassword),
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now()
            ]);

            Auth::login($newUser);

            return redirect()->intended('/');
        } else {
            Auth::login($user);
            $user->update(['last_login_at' => now()]);
            return redirect()->intended('/');
        }
    }
}
