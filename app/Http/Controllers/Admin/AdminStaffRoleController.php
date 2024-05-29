<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffRole;
use App\Traits\Admin\AdminResourceTrait;
use Illuminate\Http\Request;

class AdminStaffRoleController extends Controller
{
    use AdminResourceTrait;

    public function index()
    {
        return $this->indexResources('StaffRoles', StaffRole::class);
    }
}
