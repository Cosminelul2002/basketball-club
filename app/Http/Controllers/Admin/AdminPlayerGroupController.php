<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\Admin\AdminPlayerGroupTrait;
use App\Traits\Admin\AdminResourceTrait;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdatePlayerGroupRequest;
use App\Models\Coach;
use App\Models\Group;
use Codestage\Authorization\Attributes\Authorize;
use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

#[Authorize]
class AdminPlayerGroupController extends Controller
{
    use AdminPlayerGroupTrait, AdminResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function index()
    {
        // return $this->indexResources('Groups', Group::class, ['coaches', 'players']);
        try {
            $groups = Group::query()
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
                ->through(function ($groups) {
                    return [
                        'id' => $groups->id,
                        'name' => $groups->name,
                        'tax' => $groups->tax,
                        'number_of_players' => $groups->players->count(),
                        'staff' => $groups->staff->map(function ($staff) {
                            return $staff->first_name . ' ' . $staff->last_name;
                        })->implode(', '),
                    ];
                });
            // dd($groups);
            return Inertia::render('Admin/Groups/List', [
                'groups' => $groups,
                'prevFilters' => Request::input('filters') ?? [],
            ]);
        } catch (RelationNotFoundException $e) {
            dd($e);
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Groups'), null, 500, $e);
        } catch (QueryException $e) {
            dd($e);
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Players'), null, 500, $e);
        } catch (Exception $e) {
            dd($e);
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $playerGroup
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function show($id)
    {
        return $this->show_player_group($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $playerGroup
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function create()
    {
        return $this->createResourceView('PlayerGroups');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function store(StoreGroupRequest $request)
    {
        return $this->storeResource($request, Group::class, 'admin.dashboard.groups.index', 'Grup creat cu succes!');
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Models\Group  $playerGroup
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function update($id, UpdatePlayerGroupRequest $request)
    {
        return $this->update_player_group($request, $id);
    }

    public function createDefaultGroups()
    {
        return $this->create_default_groups();
    }

    /**
     * Delete the specified resource from storage.
     * 
     * @param  \App\Models\Group  $playerGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function destroy($id)
    {
        return $this->destroy_player_group($id);
    }
}
