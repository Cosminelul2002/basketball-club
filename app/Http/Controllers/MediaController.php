<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource for the media page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Media/Index');
    }
}
