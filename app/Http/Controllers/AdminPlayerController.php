<?php

namespace App\Http\Controllers;

use App\Admin\Traits\AdminPlayerTrait;
use App\Admin\Traits\AdminResourceTrait;
use App\Enums\Positions;
use App\Http\Requests\PlayerRequest;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UserRequest;
use App\Models\Player;
use App\Models\PlayerGroup;
use App\Models\User;
use Codestage\Authorization\Attributes\Authorize;
use Codestage\Authorization\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

#[Authorize]
class AdminPlayerController extends Controller
{
    use AdminResourceTrait, AdminPlayerTrait;

    #[Authorize(roles: ['admin', 'player'])]
    public function dashboard()
    {
        return Inertia::render('Player/Dashboard');
    }

    #[Authorize(roles: 'admin')]
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

        return $this->index_players();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'admin')]
    public function show(Player $player)
    {
        return $this->show_player($player);
    }

    /**
     * List the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'admin')]
    public function create()
    {
        return $this->create_player_view();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlayerRequest  $playerRequest
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'admin')]
    public function store(StorePlayerRequest $playerRequest)
    {
        return $this->store_player($playerRequest);
    }

    /**
     * List the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'admin')]
    public function edit(Player $player)
    {
        return $this->showResource('Players', $player);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePlayerRequest  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'admin')]
    public function update(StorePlayerRequest $request, Player $player)
    {
        return $this->update_player($request, $player);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'admin')]
    public function destroy(Player $player)
    {
        return $this->destroyResource($player, 'admin.dashboard.players.index', 'Jucător șters cu succes!');
    }
}
