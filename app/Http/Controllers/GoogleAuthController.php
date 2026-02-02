<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback from Google.
     */
    public function handleProviderCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(uniqid()), // random password
                ]);
            }

            // Login the user
            Auth::login($user);

            return redirect('dashboard')->with('success', 'Logged in with Google!');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }

    //githublogin
     public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    // Handle callback
    public function callback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            $user = User::where('email', $githubUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    'password' => bcrypt(Str::random(16)),
                ]);
            }

            Auth::login($user);

            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'GitHub login failed');
        }
    }
    // facebook login 

     public function startFacebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $fbUser = Socialite::driver('facebook')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $fbUser->getEmail()],
                [
                    'name' => $fbUser->getName(),
                    'password' => bcrypt('password'), // default password
                ]
            );

            Auth::login($user);

            return redirect('/dashboard'); // your home page
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Facebook login failed.');
        }
    }
    /*LINKDEND LOGIN */
      public function loginlinkden()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function callbacklinkden()
    {
       try{ $linkedinUser = Socialite::driver('linkedin')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $linkedinUser->getEmail()],
            ['name' => $linkedinUser->getName(), 'password' => bcrypt('password')]
        );

        Auth::login($user);

        return redirect('/dashboard');
       }catch (\Exception $e) {
            return redirect('/login')->with('error', 'linkden login failed.');
       }
    }
}
