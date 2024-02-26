<?php

namespace App\Http\Controllers;

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
        return Inertia::render('PlayerGroups/List', [
            'playerGroups' => $playerGroups,
        ]);
    }
}
