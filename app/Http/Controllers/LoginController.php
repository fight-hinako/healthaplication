<?php

namespace App\Http\Controllers;

use App\Models\CreateAccount;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'max:20'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
           return back()
              ->withInput($request->only('email'))
              ->withErrors(['login' => 'メールアドレスまたはパスワードが正しくありません。']);
        }

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            Auth::login($user, $request->boolean('remember'));
        } else {
            $request->session()->put('authenticated', true);
            $request->session()->put('authenticated_email', $credentials['email']);
        }

        return redirect()->route('dashboard');
    }
}
