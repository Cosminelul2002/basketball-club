<?php

namespace App\Http\Controllers;

use App\Models\Join;
use App\Services\PlayerFromJoin;
use App\Traits\AdminJoinTrait;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
class AdminJoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function index()
    {
        return Inertia::render('Admin/Joins/List', [
            'joins' => Join::orderByDesc('created_at')->get(),
        ]);
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
        return $this->approveJoin($request, $join);
    }
}
