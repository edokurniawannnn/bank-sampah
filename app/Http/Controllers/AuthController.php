<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun Anda telah dinonaktifkan. Hubungi admin.',
            ]);
        }

        $request->session()->regenerate();

        return $this->redirectByRole($user);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'alamat'   => 'nullable|string',
            'rt_rw'    => 'nullable|string|max:20',
            'no_hp'    => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'nama'        => $validated['nama'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'alamat'      => $validated['alamat'] ?? null,
            'rt_rw'       => $validated['rt_rw'] ?? null,
            'no_hp'       => $validated['no_hp'] ?? null,
            'role'        => 'warga',
            'poin_saldo'  => 0,
            'is_active'   => true,
        ]);

        Auth::login($user);

        return redirect()->route('admin.kategori-sampah')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectByRole(User $user)
    {
        return match ($user->role) {
            'admin'   => redirect()->intended(route('admin.dashboard')),
            'petugas' => redirect()->intended(route('petugas.dashboard')),
            default   => redirect()->intended(route('warga.dashboard')),
        };
    }
}
