<?php

namespace App\Http\Controllers;

use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    use PublicResourceTrait;

    /**
     * Display the about page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_resource('About');
    }
}
