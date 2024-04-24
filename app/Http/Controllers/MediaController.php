<?php

namespace App\Http\Controllers;

use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MediaController extends Controller
{
    use PublicResourceTrait;

    /**
     * Display a listing of the resource for the media page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_resource('Media');
    }
}
