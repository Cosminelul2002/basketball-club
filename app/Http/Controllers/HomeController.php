<?php

namespace App\Http\Controllers;

use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    use PublicResourceTrait;

    /**
     * Display a listing of the resource for the home page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Home');
    }
}
