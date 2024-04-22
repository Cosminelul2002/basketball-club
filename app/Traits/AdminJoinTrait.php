<?php

namespace App\Traits;

use App\Models\Join;
use App\Services\JoinService;
use GuzzleHttp\Psr7\Request;

trait AdminJoinTrait
{
    /**
     * Approve the specified resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Join  $join
     */
    public function approveJoin(Request $request, Join $join)
    {
        JoinService::createPlayerFromJoin($join);
    }
}
