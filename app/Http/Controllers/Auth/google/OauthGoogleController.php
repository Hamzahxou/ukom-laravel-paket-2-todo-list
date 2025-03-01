<?php

namespace App\Http\Controllers\Auth\google;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OauthGoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            $user = User::updateOrCreate([
                'google_auth_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)),
                'avatar' => $googleUser->avatar,
                'token' => $googleUser->token,
                'refresh_token' => $googleUser->refresh_token,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                "icon" => "error",
                'message' => "Something went wrong",
            ]);
        }
    }
}
