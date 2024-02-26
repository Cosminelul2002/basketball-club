<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Career;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $teams = $request->get('searchQuery')
            ?
            Team::where('name', 'LIKE', '%' . $request->get('searchQuery') . '%')
            ->orderBy('created_at', 'DESC')
            ->with('event')
            ->paginate(10)
            :
            Team::query()
            ->orderBy('created_at', 'DESC')
            ->with('event')
            ->paginate(10);

        return Inertia::render('Teams/List', [
            'teams' => $teams,
        ]);
    }

    public function show(Team $team)
    {
        $players = Career::query()
            ->where('team_id', $team->id)
            ->with('player')
            ->get();

        $teamPlayers = $players->map(function ($career) {
            return $career->player;
        });

        $team['players'] = $teamPlayers;

        return Inertia::render('Teams/Show', [
            'team' => $team,
        ]);
    }

    public function edit(Team $team)
    {
        $team->load('players', 'event');
        $players = Player::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        return Inertia::render('Teams/Edit', [
            'team' => $team,
            'players' => $players,
        ]);
    }

    public function store(TeamRequest $request)
    {
    }

    public function update(Request $request, Team $team)
    {
        $players = $request->get('players');

        // if $players size is smaller that initial team size then we need to remove players from team
        if (count($players) < $team->players->count()) {
            $playersToRemove = $team->players->pluck('id')->diff($players);

            foreach ($playersToRemove as $playerID) {
                $player = Player::find($playerID);
                $player->team_id = null;

                $player->save();
            }
        } else {
            // if $players size is bigger that initial team size then we need to add players to team
            $playersToAdd = collect($players)->diff($team->players->pluck('id'));

            foreach ($playersToAdd as $playerID) {
                $player = Player::find($playerID);
                $player->team_id = $team->id;

                $player->save();
            }
        }

        return redirect()->back()->with('success', 'Team updated.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->back()->with('success', 'Team deleted.');
    }
}
