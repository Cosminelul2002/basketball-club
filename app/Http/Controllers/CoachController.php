<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoachRequest;
use App\Models\Coach;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoachController extends Controller
{
    public function index()
    {
        return Inertia::render('Coaches/List', [
            'coaches' => Coach::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Coaches/Create');
    }

    public function store(StoreCoachRequest $request)
    {
        Coach::create($request->validated());

        return redirect()->back()->with('message', 'Antrenor adăugat cu succes!');
    }
}
