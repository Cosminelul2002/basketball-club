<?php

namespace App\Http\Controllers;

use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityController extends Controller
{
    use PublicResourceTrait;

    /**
     * Display activities page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_resource('Activities');
    }
}
