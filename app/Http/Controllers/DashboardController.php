<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function show(): View
    {
        return view('dashboard');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'countdown_minutes' => ['required', 'integer', Rule::in(array_keys(config('workcountdown.options')))],
        ]);

        auth()->user()->update([
            'countdown_minutes' => $request->integer('countdown_minutes'),
        ]);

        return back()->with('success', '設定を保存しました。');
    }
}
