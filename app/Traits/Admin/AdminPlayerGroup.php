<?php

namespace App\Admin\Traits;

use App\Models\Coach;
use App\Models\PlayerGroup;
use Inertia\Inertia;

trait AdminPlayerGroupTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index_player_groups()
    {
        $playerGroups = PlayerGroup::with(['coaches', 'players'])->get();

        return Inertia::render('Admin/PlayerGroups/List', [
            'playerGroups' => $playerGroups,
            'coaches' => Coach::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request The HTTP request.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy_player_group($id)
    {
        $playerGroup = PlayerGroup::findOrFail($id);
        $playerGroup->delete();

        return redirect()->route('admin.dashboard.groups.index')->with('message', 'Grup șters cu succes!');
    }
}
