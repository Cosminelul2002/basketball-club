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

    public function show(Coach $coach)
    {
        return Inertia::render('Coaches/Show', [
            'coach' => $coach
        ]);
    }

    public function create()
    {
        return Inertia::render('Coaches/Create');
    }

    public function store(StoreCoachRequest $request)
    {
        Coach::create($request->validated());

        return redirect()->route('admin.dashboard.coaches.index')->with('message', 'Antrenor adăugat cu succes!');
    }

    public function update(Request $request, Coach $coach)
    {
        $requestData = $request->all();

        $updateData = array_filter($requestData, function ($value, $key) use ($coach) {
            return $coach->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        $coach->update($updateData);

        return redirect()->route('admin.dashboard.coaches.index')->with('message', 'Antrenor actualizat cu succes!');
    }

    public function destroy(Coach $coach)
    {
        $coach->delete();

        return redirect()->route('admin.dashboard.coaches.index')->with('message', 'Antrenor șters cu succes!');
    }
}
