<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function name(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'unique:users', 'string', 'max:255'],
        ]);

        $request->user()->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Your account has been updated.');
    }

    public function password(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', 'string', 'min:8', 'max:255'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Your password has been updated.');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'current_password',
        ]);

        $user = $request->user();

        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        $user->delete();

        return redirect('/')->with('message', 'Account successfully deleted.');
    }
}
