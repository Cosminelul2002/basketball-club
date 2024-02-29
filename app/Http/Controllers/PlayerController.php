<?php

namespace App\Http\Controllers;

use App\Enums\Positions;
use App\Http\Requests\PlayerRequest;
use App\Http\Requests\UserRequest;
use App\Models\Player;
use App\Models\PlayerGroup;
use App\Models\User;
use Codestage\Authorization\Attributes\Authorize;
use Codestage\Authorization\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PlayerController extends Controller
{
    #[Authorize(roles: 'player')]
    #[Authorize]
    public function dashboard()
    {
        return Inertia::render('Admin/Player/Dashboard');
    }

    public function index(Request $request)
    {
        // $players = $request->get('searchQuery')
        //     ?
        //     Player::where('name', 'LIKE', '%' . $request->get('searchQuery') . '%')
        //     ->orderBy('created_at', 'DESC')
        //     ->paginate(10)
        //     :
        //     Player::query()
        //     ->orderBy('created_at', 'DESC')
        //     ->paginate(10);

        $players = Player::all();

        return Inertia::render('Admin/Players/List', [
            'players' => $players->load('player_group'),
        ]);
    }

    public function show(Player $player)
    {
        $groups = PlayerGroup::all();

        return Inertia::render('Admin/Players/Show', [
            'player' => $player->load('player_group'),
            'groups' => $groups
        ]);
    }

    /**
     * List the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Players/Create', [
            'positions' => Positions::values()
        ]);
    }

    public function store(PlayerRequest $playerRequest)
    {
        $playerRequest->validated();
        $playerRequest->merge([
            'team_id' => $playerRequest->get('team_id') ? $playerRequest->get('team_id') : null,
        ]);
        $player = Player::create($playerRequest->all());
        $data = $playerRequest->all();
        $data['player_id'] = $player->id;
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->user_roles()->insert([
            'user_id' => $user->id,
            'role_id' => Role::query()->where('key', 'player')->first()->id,
            'user_type' => 'App\Models\User'
        ]);

        return redirect()->route('players.index')->with('success', 'Player created.');
    }

    public function edit(Player $player)
    {
        return Inertia::render('Admin/Players/Edit', [
            'player' => $player,
        ]);
    }

    public function update(Request $request, Player $player)
    {
        // Get the data from the request
        $requestData = $request->all();

        // Filter the data to include only the fields that are different from the current values
        $updateData = array_filter($requestData, function ($value, $key) use ($player) {
            return $player->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        if (array_key_exists('player_group', $updateData)) {
            $playerGroup = PlayerGroup::where('name', $updateData['player_group'])->first();
            $updateData['player_group_id'] = $playerGroup->id;
            unset($updateData['player_group']);
        }

        // Update the player with the filtered data
        $player->update($updateData);

        // redirect back to the same page with a success message
        return redirect()->back()->with('success', 'Player updated.');
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted.');
    }
}
