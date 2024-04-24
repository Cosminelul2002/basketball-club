<?php

namespace App\Traits\Public;

use App\Models\Coach;
use App\Models\Location;
use Inertia\Inertia;

trait ContactTrait
{
    /**
     * Display a listing of the resource for the contact page.
     *
     * @return \Inertia\Response
     */
    public function index_contact()
    {
        return  Inertia::render('Contact/Index', [
            'coaches' => Coach::all(),
            'locations' => Location::all(),
        ]);
    }
}
