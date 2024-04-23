<?php

namespace App\Http\Controllers;

use App\Traits\Admin\AdminTrait;
use App\Models\Coach;
use App\Models\Join;
use App\Models\Player;
use App\Models\PlayerGroup;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize(roles: 'admin')]
#[Authorize]
class AdminController extends Controller
{
    use AdminTrait;

    public function dashboard()
    {
        return $this->display_dashboard();
    }
}
