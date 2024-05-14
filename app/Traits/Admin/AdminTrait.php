<?php

namespace App\Traits\Admin;

use App\Models\Coach;
use App\Models\Join;
use App\Models\Location;
use App\Models\Player;
use App\Models\PlayerGroup;
use Inertia\Inertia;

/**
 * trait AdminTrait for AdminController.
 */
trait AdminTrait
{
    /**
     * Display the admin dashboard.
     *
     * @return \Inertia\Response
     */
    public function display_dashboard()
    {
        $players = Player::all()->count();
        $lastPlayers = Player::latest()->limit(5)->get();
        $coaches = Coach::all()->count();
        $playerGroups = PlayerGroup::all()->count();
        $locations = Location::all()->count();

        return Inertia::render('Admin/Dashboard', [
            'players' => $players,
            'lastPlayers' => $lastPlayers,
            'coaches' => $coaches,
            'playerGroups' => $playerGroups,
            'locations' => $locations,
        ]);
    }
}
