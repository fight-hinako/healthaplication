<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TaskController extends Controller
{
    public function show(): View
    {
        return view('home', [
            'totalSeconds' => (auth()->user()->countdown_minutes ?? 60) * 60,
            'remainingSeconds' => (auth()->user()->countdown_minutes ?? 60) * 60,
            'tasks' => config('stretchtasks.items'),
        ]);
    }
}
