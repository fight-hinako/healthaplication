<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class GoalCardController extends Controller
{
    public function show(): View
    {
        return view('goalcard', [
            'daily_tasks' => auth()->user()->daily_tasks ?? 0,
            'completed_tasks' => auth()->user()->completed_tasks ?? 0,
        ]);
    }
}
