<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Coach;
use App\Models\PlayerGroup;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
class PlayerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function index()
    {
        // Retrieve all player groups with their associated coaches and players
        $playerGroups = PlayerGroup::with(['coaches', 'players'])->get();

        // Pass the player groups to the Inertia view
        return Inertia::render('Admin/PlayerGroups/List', [
            'playerGroups' => $playerGroups,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function show(PlayerGroup $playerGroup)
    {
        return Inertia::render('Admin/PlayerGroups/Show', [
            'playerGroup' => $playerGroup->load('coaches', 'players')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function create()
    {
        return Inertia::render('Admin/PlayerGroups/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function store(StoreGroupRequest $request)
    {
        $request->validated();

        PlayerGroup::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.dashboard.groups.index')->with('message', 'Grup adăugat cu succes!');
    }

    /**
     * Delete the specified resource from storage.
     * 
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function destroy($id)
    {
        $playerGroup = PlayerGroup::findOrFail($id);
        $playerGroup->delete();

        return redirect()->route('admin.dashboard.groups.index')->with('message', 'Grup șters cu succes!');
    }
}
