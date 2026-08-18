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
        $validated = $request->validate([
            'total_goals' => ['required', 'integer'],
            'countdown_minutes' => ['required', 'integer'],
            'daily_tasks' => ['required', 'integer'],
            'reward' => ['required', 'string', 'max:255'],
        ]);

        auth()->user()->update($validated);

        return redirect()->route('home');

    }
    public function createGoalCardUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'daily_tasks' => ['required', 'integer'],
        ]);
        return redirect()->route('goalcard');
    }
}