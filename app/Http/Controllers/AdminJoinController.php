<?php

namespace App\Http\Controllers;

use App\Models\Join;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminJoinController extends Controller
{
    public function index()
    {
        $joins = Join::orderByDesc('created_at')->get();

        return Inertia::render('Joins/List', [
            'joins' => $joins,
        ]);
    }
}
