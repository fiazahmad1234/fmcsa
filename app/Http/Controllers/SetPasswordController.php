<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use Carbon\Carbon;
use App\Models\User;


class SetPasswordController extends Controller
{
        public function requestForm() {
        return view('setpassword.password');
        }

       public function sendLink(Request $request) {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'This email does not exist.']);
        }

        // Generate a random token
        $token = Str::random(64);

        // Store token in cache for 60 minutes
        Cache::put('password_reset_'.$token, $request->email, now()->addMinutes(60));

        // Send email link
        $link = url('password/set/'.$token);
        Mail::raw("Click here to set your password: $link", function($message) use ($request) {
            $message->to($request->email)->subject('Set Your Password');
        });

        return back()->with('status','Check your email for the set password link.');
    }

    // Show set password form
    public function showForm($token) {
        $email = Cache::get('password_reset_'.$token);
        if (!$email) {
            return redirect()->route('reset')->withErrors(['email' => 'This link is invalid or expired.']);
        }

        return view('setpassword.set_password', ['email' => $email, 'token' => $token]);
    }

    // Save new password
    public function setPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $cachedEmail = Cache::get('password_reset_'.$request->token);
        if (!$cachedEmail || $cachedEmail != $request->email) {
            return back()->withErrors(['email' => 'This link is invalid or expired.']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Invalid email.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete token
        Cache::forget('password_reset_'.$request->token);

        return redirect('/login')->with('status','Password set successfully!');
    }
}
