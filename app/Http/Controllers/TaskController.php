<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function show(): View
    {
        return view('home', [
            'totalSeconds' => (auth()->user()->countdown_minutes ?? 60) * 60,
            'remainingSeconds' => (auth()->user()->countdown_minutes ?? 60) * 60,
            'completedTasks' => auth()->user()->completed_tasks  ?? 0,
            'tasks' => config('stretchtasks.items'),
        ]);
    }

    public function updateCompletedTasks(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'completed_tasks' => ['required', 'integer', 'min:0'],
        ]);

        $user = auth()->user();
        $user->update([
            'completed_tasks' => $validated['completed_tasks'],
        ]);

        return response()->json([
            'completed_tasks' => $user->completed_tasks ?? 0,
        ]);
    }

    public function updateSoundEnabled(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sound_enabled' => ['required', 'boolean'],
        ]);

        $user = auth()->user();
        $user->update([
            'sound_enabled' => $validated['sound_enabled'],
        ]);

        return response()->json([
            'sound_enabled' => (bool) $user->sound_enabled,
        ]);
    }
}
