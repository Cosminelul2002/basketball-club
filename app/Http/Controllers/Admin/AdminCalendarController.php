<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Admin\AdminResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCalendarController extends Controller
{
    use AdminResourceTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Inertia::render('Admin/Calendar/Show');
    }
}
