<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        Log::info('Login attempt for email: ' . $request->email);
        // Attempt authentication without role condition
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
           // Log::info('Login successful for user: ' . $user->id . ', Roles: ' . json_encode($user->getRoleNames()) . ', Table Role: ' . $user->role);
            if ($user->hasRole('Admin') || $user->hasRole === 'Super Admin') {
                Log::info('Redirecting to admin dashboard');
                return redirect()->route('dashboard');
            }
            Log::info('Redirecting to user dashboard');
            return redirect()->route('user.dashboard');
        }

        Log::warning('Login failed for email: ' . $request->email);
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}