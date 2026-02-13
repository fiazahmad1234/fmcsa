<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Http\Request; // ✅ This is the correct Request class
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\EmailConfiguration;
use App\Models\Subscriber;



class ProPaymentController extends Controller
{
   public function userplan()
{
    $user = auth()->user(); // get logged-in user

    if (!$user) {
        return redirect()->route('login');
    }

    // Fetch all payments for the user, latest first
    $payments = Payment::where('user_id', $user->id)
                    // ->where('status', 'paid') // optional: only paid
                    ->latest('created_at')
                    ->get();

    $planData = [];

    foreach ($payments as $payment) {
        // Make sure created_at exists
        if ($payment->created_at) {
            $createdAt = Carbon::parse($payment->created_at);
            $expiryDate = $createdAt->copy()->addMonths(1); // 1-month plan
            $remainingDays = Carbon::now()->diffInDays($expiryDate, false);
            $remainingDays = max($remainingDays, 0); // never negative

            // Add payment info to array
            $planData[] = [
                'email' => $payment->email,
                'plan' => ucfirst($payment->plan),
                'amount' => $payment->amount,
                'currency' => $payment->currency,
                'status' => ucfirst($payment->status),
                'start_date' => $createdAt->format('d M Y'),
                'expiry_date' => $expiryDate->format('d M Y'),
                'remaining_days' => $remainingDays,
            ];
        }
    }

    // Optional: if you want only the latest plan for quick view
    $latestPlan = $planData[0] ?? null;

    return view('dashboard.user_plan', compact('user', 'planData', 'latestPlan'));
}
    public function paidusers(){
 $payments = Payment::orderBy('created_at', 'desc')->get();

    // Optional: total counts for cards
    $totalUsers = $payments->pluck('user_id')->unique()->count();
    $totalAmount = $payments->sum('amount');
    $totalPayments = $payments->count();

    return view('dashboard.paidusers', compact('payments', 'totalUsers', 'totalAmount', 'totalPayments'));

    }



  public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                @unlink(storage_path('app/public/profile_images/'.$user->profile_image));
            }
            $imageName = time().'.'.$request->profile_image->extension();
            $request->profile_image->storeAs('profile_images', $imageName, 'public');
            $user->profile_image = $imageName;
        }

        $user->save();

        return back()->with('success', 'Profile image updated successfully');
    }

     public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    // Update profile
    public function profile_edite(Request $request){

    // Pass the curently logged-in user to the view
    $user = auth()->user();

    return view('dashboard.profile', compact('user'));


    }


    public function profile_update(Request $request)
    {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
        ]);

        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update profile image
      
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
   
    public function email_configruation(){
        return view('dashboard.email_configuration');
    }



public function email_validation(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:email_configurations,email,' . Auth::id() . ',user_id', // allow current user
        'password' => 'required|string|min:6',
        'smtp_host' => 'nullable|string',
        'smtp_port' => 'nullable|integer',
        'smtp_encryption' => 'nullable|boolean',
    ]);

    EmailConfiguration::updateOrCreate(
        ['user_id' => Auth::id()], // match existing configuration for user
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password, // securely hash password
            'smtp_host' => $request->smtp_host,
            'smtp_port' => $request->smtp_port,
            'smtp_encryption' => $request->smtp_encryption ?? true,
        ]
    );

    return redirect()->back()->with('success', 'Email configuration saved successfully!');
}


public function show_email_configurations()
{
    // Get all email configs for logged-in user
    $configs = EmailConfiguration::where('user_id', Auth::id())->get();

    return view('dashboard.show_configuration', compact('configs'));
}
public function all_configurations()
{
    // Get all email configs for logged-in user
    $configs = EmailConfiguration::all();

    return view('dashboard.all_configuration', compact('configs'));
}

public function subscriber_stor(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:subscribers,email'
    ]);

    Subscriber::create([
        'email' => $request->email
    ]);

return back()->with('success', 'Subscribed Successfully!');
}
public function subscriber_home(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:subscribers,email'
    ]);

       try {
        Subscriber::create([
            'email' => $request->email
        ]);

        return back()->with('success1', 'Subscribed Successfully!');
    } catch (\Exception $e) {
        // Return a specific error message
        return back()->with('error1', 'Failed to subscribe. Please try again.');
    }
}
public function showSubscribers()
{
    $subscribers = Subscriber::all(); // fetch all rows
    return view('dashboard.subscribers', compact('subscribers'));
}



}
