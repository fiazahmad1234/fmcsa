<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Http\Request; // ✅ This is the correct Request class

class ProPaymentController extends Controller
{
    public function check($plan) // <-- plan from URL
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Please login first.');
        }

        $payment = Payment::where('user_id', $user->id)
            ->where('status', 'success')
            ->latest()
            ->first();

        if (!$payment) {
            return redirect('/checkout')
                ->with('info', 'Please complete payment first.');
        }

        // 🔥 Match URL plan with DB plan
        if ($payment->plan === $plan) {
            return view('dashboard.index'); // <-- AUTO BREAK
        }

        return redirect('/checkout')
            ->with('info', 'Plan does not match your payment.');
    }
    public function paidusers()
{
    // Get all payments
    $payments = Payment::all(); // Or paginate with ->paginate(10);
   $totalUsers = payment::count('id');
    $totalAmount = Payment::sum('amount');
    $totalPayments = Payment::count();

    return view('dashboard.paidusers', compact('payments', 'totalUsers', 'totalAmount', 'totalPayments'));
} //profile iamge at dashboar
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
}
