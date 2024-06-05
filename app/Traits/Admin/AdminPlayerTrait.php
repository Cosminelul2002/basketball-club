<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Enums\Positions;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Player;
use App\Models\Group;
use App\Models\PlayerGroup;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

trait AdminPlayerTrait
{
    /**
     * Render the index page for players.
     *
     * @return \Inertia\Response
     */
    public function index_players($request)
    {
        try {
            $players = Player::query()
                ->orderBy('created_at', 'desc')
                ->when(Request::input('filters'), function ($query, $filters) {
                    if (isset($filters['searchName'])) {
                        $query->where('first_name', 'like', '%' . $filters['searchName'] . '%');
                        // ->orWhere('last_name', 'like', '%' . $filters['searchName'] . '%');
                    }

                    if (isset($filters['searchGroup'])) {
                        $query->whereHas('groups', function ($groupQuery) use ($filters) {
                            $groupQuery->where('name', 'like', '%' . $filters['searchGroup'] . '%');
                        });
                    }

                    if (isset($filters['searchSkill_level'])) {
                        $query->where('skill_level', $filters['searchSkill_level']);
                    }

                    if (isset($filters['searchYear'])) {
                        $query->whereYear('date_of_birth', $filters['searchYear']);
                    }
                })
                ->paginate(9)
                ->withQueryString()
                ->through(function ($player) {
                    return [
                        'id' => $player->id,
                        'first_name' => $player->first_name,
                        'last_name' => $player->last_name,
                        'date_of_birth' => $player->date_of_birth,
                        'skill_level' => $player->skill_level,
                        'parent_name' => $player->parent_name,
                        'parent_phone' => $player->parent_phone,
                        'groups' => $player->groups->pluck('name')->toArray(),
                    ];
                });

            return Inertia::render('Admin/Players/List', [
                'players' => $players,
                'groups' => Group::all(),
                'prevFilters' => Request::input('filters') ?? [],
            ]);
        } catch (RelationNotFoundException $e) {
            dd($e);
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Groups'), null, 500, $e);
        } catch (QueryException $e) {
            dd($e);
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
                'player' => $player->load('groups'),
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
            $group = Group::where('id', $requestData['group_id'])->first();
            if ($group) {
                $player = Player::create($requestData);
                PlayerGroup::create([
                    'player_id' => $player->id,
                    'group_id' => $group->id,
                ]);
            } else {
                $requestData['group_id'] = null;
                Player::create($requestData);
            }

            return redirect()->route('admin.dashboard.players.index')->with('message', 'Jucător adăugat cu succes!.');
        } catch (QueryException $e) {
            dd($e);
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Players'), null, 500, $e);
        } catch (Exception $e) {
            dd($e);
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

                if ($key === 'groups') {
                    // get all groups that have been selected
                    $playerGroups = PlayerGroup::where('player_id', $player->id)->get();
                    $ids = $playerGroups->pluck('group_id')->toArray();

                    $groupsToAdd = array_diff($value, $ids);
                    $groupsToRemove = array_diff($ids, $value);

                    if (count($groupsToAdd) > 0) {
                        foreach ($groupsToAdd as $group) {
                            PlayerGroup::create([
                                'player_id' => $player->id,
                                'group_id' => $group,
                            ]);
                        }
                    }

                    if (count($groupsToRemove) > 0) {
                        foreach ($groupsToRemove as $group) {
                            PlayerGroup::where('player_id', $player->id)->where('group_id', $group)->delete();
                        }
                    }

                    return false;
                }

                return $player->{$key} !== $value;
            }, ARRAY_FILTER_USE_BOTH);
            // if (array_key_exists('groups', $updateData)) {
            //     dd($updateData['groups']);
            //     $playerGroup = Group::where('name', $updateData['player_group'])->first();
            //     $updateData['player_group_id'] = $playerGroup->id;
            //     unset($updateData['player_group']);
            // }

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
