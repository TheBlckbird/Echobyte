<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): void
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:users', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'string', 'min:8', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'remember' => 'boolean',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials, $validated['remember'] ?? false)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        /** @psalm-suppress TooManyArguments */
        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->onlyInput('name');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
