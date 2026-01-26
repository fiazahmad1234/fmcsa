<?php

namespace App\Http\Controllers\Auth;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Carbon;
// ✅ Add this


class LoginController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);
      $user = User::where('email', 'riazahmad13072@gmail.com')->first();
      $user->password = Hash::make('riaz@13072'); // replace with actual password
     $user->save();

        $credentials = $request->only('email', 'password');
            $remember = $request->filled('remember');


        if (Auth::attempt($credentials,$remember)) {
            $request->session()->regenerate();
          $user = auth()->user();
        

$now = Carbon::now('Asia/Karachi');
$today = $now->toDateString();

// Time range: 3 PM – 11:59 PM
$start = Carbon::createFromTime(15, 0, 0, 'Asia/Karachi');
$end   = Carbon::createFromTime(23, 59, 59, 'Asia/Karachi');

if ($now->between($start, $end)) {

    Attendance::firstOrCreate(
        [
            'user_id' => $user->id,
            'date' => $today,
        ],
        [
            'login_time' => $now->format('H:i:s'),
            'status' => 'present',
        ]
    );
}
$data = Attendance::all();
$tottalproject = Attendance::where('user_id', $user->id)->where('project', 'new-task')->count(); // get all attendance records
 // get all attendance records
    return view('dashboard', compact(['data','tottalproject']));
            
        }
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
