<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return  Inertia::render('Contact/Show', [
            'coaches' => Coach::all(),
            'locations' => Location::all(),
        ]);
    }
}
