<?php

namespace App\Http\Controllers;

use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParentController extends Controller
{
    #[Authorize(roles: 'parent')]
    #[Authorize]
    public function dashboard()
    {
        return Inertia::render('Parent/Dashboard');
    }
}
