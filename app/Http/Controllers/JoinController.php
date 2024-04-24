<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJoinRequest;
use App\Models\Join;
use App\Traits\Public\JoinTrait;
use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JoinController extends Controller
{
    use PublicResourceTrait, JoinTrait;

    /**
     * Display the create join page.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->create_resource('Join');
    }

    /**
     * Store a newly created resource in database for the join form.
     *
     * @param StoreJoinRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreJoinRequest $request)
    {
        return $this->store_join($request);
    }
}
