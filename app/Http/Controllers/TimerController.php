<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TimerController extends Controller
{
    public function show(): View
    {
        $minutes = auth()->user()->countdown_minutes ?? 60;
        $totalSeconds = $minutes * 60;

        return view('workcountcard', [
            'totalSeconds' => $totalSeconds,
            'remainingSeconds' => $totalSeconds,
        ]);
    }
}

   