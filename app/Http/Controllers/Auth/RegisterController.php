<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:users', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'string', 'min:8', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        auth()->login($user);
    }
}
