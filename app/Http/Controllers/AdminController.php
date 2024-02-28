<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Join;
use App\Models\Player;
use App\Models\PlayerGroup;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize(roles: 'admin')]
#[Authorize]
class AdminController extends Controller
{
    public function dashboard()
    {
        $players = Player::all()->count();
        $lastPlayers = Player::latest()->limit(5)->get();
        $coaches = Coach::all()->count();
        $playerGroups = PlayerGroup::all()->count();
        $joins = Join::all()->count();
        $lastJoins = Join::latest()->limit(5)->get();

        return Inertia::render('Admin/Dashboard', [
            'players' => $players,
            'lastPlayers' => $lastPlayers,
            'coaches' => $coaches,
            'playerGroups' => $playerGroups,
            'joins' => $joins,
            'lastJoins' => $lastJoins,
        ]);
    }
}
