<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminLocationController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Locations/List', [
            'locations' => Location::all(),
        ]);
    }
}
