<?php

namespace App\Http\Controllers;

use Codestage\Authorization\Attributes\Authorize;
use Inertia\Inertia;

class PlayerController extends Controller
{

    #[Authorize(roles: ['admin', 'player'])]
    public function dashboard()
    {
        return Inertia::render('Player/Dashboard');
    }
}
