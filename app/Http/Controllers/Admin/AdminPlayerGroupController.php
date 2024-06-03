<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Admin\AdminPlayerGroupTrait;
use App\Traits\Admin\AdminResourceTrait;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdatePlayerGroupRequest;
use App\Models\Coach;
use App\Models\Group;
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
        return $this->indexResources('Groups', Group::class, ['coaches', 'players']);
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
