<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoachController extends Controller
{
    public function index()
    {
        return Inertia::render('Coaches/List', [
            'coaches' => Coach::all(),
        ]);
    }

    public function show(Coach $coach)
    {
        return Inertia::render('Coaches/Show', [
            'coach' => $coach,
        ]);
    }
}
