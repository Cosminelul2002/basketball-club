<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Enums\Positions;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Player;
use App\Models\Group;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
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
        try {
            $players = Player::all();

            return Inertia::render('Admin/Players/List', [
                'players' => $players->load('player_group'),
                'groups' => Group::all(),
            ]);
        } catch (RelationNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Groups'), null, 500, $e);
        } catch (QueryException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Players'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Render the show page for a player.
     *
     * @param \App\Models\Player $player The player to display.
     * @return \Inertia\Response
     */
    public function show_player(Player $player)
    {
        try {
            return Inertia::render('Admin/Players/Show', [
                'player' => $player->load('player_group'),
                'groups' => Group::all(),
            ]);
        } catch (RelationNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Groups'), null, 500, $e);
        } catch (ModelNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Player'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Render the create page for a player.
     *
     * @return \Inertia\Response
     */
    public function create_player_view()
    {
        try {
            return Inertia::render('Admin/Players/Create', [
                'positions' => Positions::values(),
                'groups' => Group::all(),
            ]);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Store a new player in the database.
     *
     * @param \App\Http\Requests\StorePlayerRequest $request The HTTP request.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_player(StorePlayerRequest $request)
    {
        try {
            $requestData = $request->validated();

            $playerGroup = Group::where('id', $requestData['player_group_id'])->first();
            if ($playerGroup) {
                Player::create($requestData);
            } else {
                $requestData['player_group_id'] = null;
                Player::create($requestData);
            }

            return redirect()->route('admin.dashboard.players.index')->with('message', 'Jucător adăugat cu succes!.');
        } catch (QueryException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Players'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralStoreResourceError(), null, 500, $e);
        }
    }

    /**
     * Render the edit page for a player.
     *
     * @param \App\Models\Player $player The player to edit.
     * @return \Inertia\Response
     */
    public function update_player($request, Player $player)
    {
        try {
            $requestData = $request->validated();
            
            $updateData = array_filter($requestData, function ($value, $key) use ($player) {
                return $player->{$key} !== $value;
            }, ARRAY_FILTER_USE_BOTH);

            if (array_key_exists('player_group', $updateData)) {
                $playerGroup = Group::where('name', $updateData['player_group'])->first();
                $updateData['player_group_id'] = $playerGroup->id;
                unset($updateData['player_group']);
            }
            
            $player->update($updateData);

            return redirect()->route('admin.dashboard.players.index')->with('message', 'Jucător actualizat cu succes!.');
        } catch (ModelNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Player'), null, 500, $e);
        } catch (QueryException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Player'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralUpdateResourceError(), null, 500, $e);
        }
    }
}
