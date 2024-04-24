<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Traits\Public\CoachTrait;
use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoachController extends Controller
{
    use PublicResourceTrait, CoachTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_coach();
    }

    /**
     * Display the specified resource.
     *
     * @param Coach $coach
     * @return \Inertia\Response
     */
    public function show(Coach $coach)
    {
        return $this->show_resource('Coaches', $coach);
    }
}
