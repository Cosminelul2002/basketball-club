<?php

namespace App\Traits\Public;

use App\Models\Coach;
use Inertia\Inertia;

trait CoachTrait
{
    /**
     * Display a listing of the resource for the coaches.
     *
     * @return \Inertia\Response
     */
    public function index_coach()
    {
        return Inertia::render('Coaches/Index', [
            'coaches' => Coach::all(),
        ]);
    }
}
