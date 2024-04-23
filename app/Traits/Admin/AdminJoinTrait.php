<?php

namespace App\Admin\Traits;

use App\Models\Join;
use App\Services\JoinService;
use Illuminate\Http\Request;
use Inertia\Inertia;

trait AdminJoinTrait
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index_joins()
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
    public function approve_join(Request $request, Join $join)
    {
        JoinService::createPlayerFromJoin($join);
    }
}
