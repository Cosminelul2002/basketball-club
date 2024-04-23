<?php

namespace App\Traits\Admin;

use App\Enums\Positions;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Player;
use App\Models\PlayerGroup;
use Inertia\Inertia;

trait AdminPlayerTrait
{
    /**
     * Render the index page for players.
     *
     * @return \Inertia\Response
     */
    public function index_players()
    {
        $players = Player::all();

        return Inertia::render('Admin/Players/List', [
            'players' => $players->load('player_group'),
            'groups' => PlayerGroup::all(),
        ]);
    }

    /**
     * Render the show page for a player.
     *
     * @param \App\Models\Player $player The player to display.
     * @return \Inertia\Response
     */
    public function show_player(Player $player)
    {
        return Inertia::render('Admin/Players/Show', [
            'player' => $player->load('player_group'),
            'groups' => PlayerGroup::all(),
        ]);
    }

    /**
     * Render the create page for a player.
     *
     * @return \Inertia\Response
     */
    public function create_player_view()
    {
        return Inertia::render('Admin/Players/Create', [
            'positions' => Positions::values(),
            'groups' => PlayerGroup::all(),
        ]);
    }

    /**
     * Store a new player in the database.
     *
     * @param \App\Http\Requests\StorePlayerRequest $request The HTTP request.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_player(StorePlayerRequest $request)
    {
        $requestData = $request->validated();

        $playerGroup = PlayerGroup::where('id', $requestData['player_group_id'])->first();
        if ($playerGroup) {
            Player::create($requestData);
        }

        return redirect()->route('admin.dashboard.players.index')->with('message', 'Jucător adăugat cu succes!.');
    }

    /**
     * Render the edit page for a player.
     *
     * @param \App\Models\Player $player The player to edit.
     * @return \Inertia\Response
     */
    public function update_player(StorePlayerRequest $request, Player $player)
    {
        $requestData = $request->validated();

        $updateData = array_filter($requestData, function ($value, $key) use ($player) {
            return $player->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        if (array_key_exists('player_group', $updateData)) {
            $playerGroup = PlayerGroup::where('name', $updateData['player_group'])->first();
            $updateData['player_group_id'] = $playerGroup->id;
            unset($updateData['player_group']);
        }

        $player->update($updateData);

        return redirect()->route('admin.dashboard.players.index')->with('message', 'Jucător actualizat cu succes!.');
    }
}
