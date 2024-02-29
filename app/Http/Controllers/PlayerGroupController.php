<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Coach;
use App\Models\PlayerGroup;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlayerGroupController extends Controller
{
    public function index()
    {
        // Retrieve all player groups with their associated coaches and players
        $playerGroups = PlayerGroup::with(['coaches', 'players'])->get();

        // Pass the player groups to the Inertia view
        return Inertia::render('Admin/PlayerGroups/List', [
            'playerGroups' => $playerGroups,
        ]);
    }

    public function show(PlayerGroup $playerGroup)
    {
        return Inertia::render('Admin/PlayerGroups/Show', [
            'playerGroup' => $playerGroup->load('coaches', 'players')
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/PlayerGroups/Create');
    }

    public function store(StoreGroupRequest $request)
    {
        $request->validated();

        PlayerGroup::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.dashboard.groups.index')->with('message', 'Grup adăugat cu succes!');
    }

    public function destroy($id)
    {
        $playerGroup = PlayerGroup::findOrFail($id);
        $playerGroup->delete();

        return redirect()->route('admin.dashboard.groups.index')->with('message', 'Grup șters cu succes!');
    }
}
