<?php

namespace App\Http\Controllers;

use App\Admin\Traits\AdminJoinTrait;
use App\Admin\Traits\AdminResourceTrait;
use App\Models\Join;
use App\Services\PlayerFromJoin;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
class AdminJoinController extends Controller
{
    use AdminJoinTrait, AdminResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function index()
    {
        return $this->index_joins();
    }

    /**
     * Approve the specified resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Join  $join
     */
    #[Authorize(roles: 'admin')]
    public function approve(Request $request, Join $join)
    {
        return $this->approve_join($request, $join);
    }

    /**
     * Delete the specified resource.
     * 
     * @param  \App\Models\Join  $join
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Join $join)
    {
        return $this->destroyResource($join, 'admin.dashboard.joins.index', 'înregistrarea de înscriere a fost ștearsă cu succes.');
    }
}
