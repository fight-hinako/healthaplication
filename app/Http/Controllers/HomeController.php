<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   public function show(): View
   {
        $minutes = auth()->user()->countdown_minutes ?? 60;
        $totalSeconds = $minutes * 60;

        return view('home', [
            'minutes' => $minutes, 
            'totalSeconds' => $totalSeconds,
            'remainingSeconds' => $totalSeconds,
            'tasks' => config('stretchtasks.items'),
        ]);

    }
}
