<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin() ? redirect('/admin') : redirect('/member');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'identifier' => 'required|string',
            'password' => 'required',
        ]);

        // Sesuai PRD: login boleh pakai Email ATAU Nomor Handphone + Password.
        $field = filter_var($validated['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [$field => $validated['identifier'], 'password' => $validated['password']];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return Auth::user()->isAdmin() ? redirect('/admin') : redirect('/member');
        }

        return back()->withErrors([
            'identifier' => 'Email/No. HP atau password salah.',
        ])->onlyInput('identifier');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/member');
        }

        if (session('guest_transaction_count', 0) < 10) {
            return redirect('/')->with('error', 'Harus melakukan 10x transaksi');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        if (session('guest_transaction_count', 0) < 10) {
            return redirect('/')->with('error', 'Harus melakukan 10x transaksi sebelum dapat mendaftar.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:500',
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'points' => 50, // Bonus pendaftaran
            'member_level' => 'bronze',
        ]);

        // Create point history for registration bonus
        $user->pointHistories()->create([
            'points' => 50,
            'type' => 'earn',
            'description' => 'Bonus Pendaftaran Member Sobat Lapak',
        ]);

        Auth::login($user);

        return redirect('/member')->with('success', '🎉 Selamat datang di Sobat Lapak! Anda mendapatkan 50 poin bonus pendaftaran.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
