<?php

namespace App\Http\Controllers;

use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    use PublicResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_resource('Subscribe');
    }
}
