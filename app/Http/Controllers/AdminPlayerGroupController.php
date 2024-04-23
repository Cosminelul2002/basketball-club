<?php

namespace App\Http\Controllers;

use App\Admin\Traits\AdminPlayerGroupTrait;
use App\Admin\Traits\AdminResourceTrait;
use App\Http\Requests\StoreGroupRequest;
use App\Models\Coach;
use App\Models\PlayerGroup;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
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
        return $this->index_player_groups();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function show(PlayerGroup $playerGroup)
    {
        return $this->showResource('PlayerGroups', $playerGroup);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlayerGroup  $playerGroup
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
        return $this->storeResource($request, PlayerGroup::class, 'admin.dashboard.groups.index', 'Grup creat cu succes!');
    }

    /**
     * Delete the specified resource from storage.
     * 
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function destroy($id)
    {
        return $this->destroy_player_group($id);
    }
}
