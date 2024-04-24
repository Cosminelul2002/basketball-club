<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Admin\AdminTrait;
use Codestage\Authorization\Attributes\Authorize;

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
