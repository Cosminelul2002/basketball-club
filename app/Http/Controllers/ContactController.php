<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Location;
use App\Traits\Public\ContactTrait;
use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{

    use PublicResourceTrait, ContactTrait;

    /**
     * Display a listing of the resource for the contact page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_contact();
    }
}
