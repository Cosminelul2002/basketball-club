<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Traits\Admin\AdminResourceTrait;
use App\Traits\Admin\AdminStaffTrait;
use Illuminate\Http\Request;

class AdminStaffController extends Controller
{
    use AdminResourceTrait, AdminStaffTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('Staff', Staff::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->create_staff();
    }
}
