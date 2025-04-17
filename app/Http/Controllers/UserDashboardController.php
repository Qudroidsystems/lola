<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();
        $billingAddress = $user->billingAddress()->first();

        \Log::info('Dashboard accessed for user: ' . $user->id . ', Orders found: ' . $orders->count());
        return view('frontend.user-dashboard', compact('user', 'orders', 'billingAddress'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Account updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating account: ' . $e->getMessage());
        }
    }
}
