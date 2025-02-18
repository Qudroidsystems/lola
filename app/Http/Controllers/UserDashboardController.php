<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();


        // Retrieve orders and billing address
        $orders = $user->orders ?? [];
        $billingAddress = $user->billingAddress ?? null;

        return view('dashboard', compact('user', 'orders', 'billingAddress'));
    }
}
