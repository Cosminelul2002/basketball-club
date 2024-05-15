<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Traits\Admin\AdminResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminEventController extends Controller
{

    use AdminResourceTrait;

    /**
     * Display create form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->createResourceView('Events');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        return $this->storeResource($request, Event::class, 'admin.dashboard.calendar.index', 'Evenimentul a fost adăugat cu succes!');
    }
}
