<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;


class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function login() {
        return view('admin.auth.login');
    }

    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->route('admin.login')
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    // Handle logout
    public function logout()
    {
        // Auth::guard('admin')->logout();
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function showLinkRequestForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // $stat = Password::sendResetLink(['email' => 'pankajvajipara5191@gmail.com']);
        // dd($stat);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'We have emailed your password reset link!')
            : back()->withErrors(['email' => 'Failed to send reset link. Try again.']);
    }

    public function showResetForm($token)
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->update(['password' => Hash::make($password)]);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('success', 'Password reset successful. You can now login.')
            : back()->withErrors(['email' => 'Invalid token or email.']);
    }
}
