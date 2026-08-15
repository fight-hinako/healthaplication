<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateGolasController extends Controller
{
    public function create(): View
    {
        return view('creategoals');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'total_goals' => ['required', 'integer'],
            'countdown_minutes' => ['required', 'integer'],
            'daily_tasks' => ['required', 'integer'],
            'reward' => ['required', 'string', 'max:255'],
        ]);

        $validated = $request->validate([
            'total_goals' => ['required', 'integer'],
            'countdown_minutes' => ['required', 'integer'],
            'daily_tasks' => ['required', 'integer'],
            'reward' => ['required', 'string', 'max:255'],
        ]);
        return redirect()->route('home');

    }
}