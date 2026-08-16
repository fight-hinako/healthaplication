<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CreateAccountController extends Controller
{
    public function create(): View
    {
        return view('createaccount');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
           'email' => ['required', 'email', 'unique:users,email'],
           'password' => ['required', Password::default(), 'confirmed'],
        ]);

        User::create([
            'name' => Str::before($validated['email'], '@'),
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'アカウントを作成しました。');
    }
}
