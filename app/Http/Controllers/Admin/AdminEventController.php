<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Traits\Admin\AdminEventTrait;
use App\Traits\Admin\AdminResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminEventController extends Controller
{

    use AdminResourceTrait, AdminEventTrait;

    /**
     * Display a listing of the events.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('Events', Event::class);
    }

    /**
     * Display the specified event.
     *
     * @param \App\Models\Event $event
     * @return \Inertia\Response
     */
    public function show(Event $event)
    {
        return $this->showResource('Events', $event);
    }

    /**
     * Display create form.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->createResourceView('Events');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Inertia\Response
     */
    public function store(StoreEventRequest $request)
    {
        return $this->storeResource($request, Event::class, 'admin.dashboard.calendar.index', 'Evenimentul a fost adăugat cu succes!');
    }

    /**
     * Update the specified event.
     *
     * @param \App\Models\Event $event
     * @return \Inertia\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        return $this->updateResource($request, $event, 'admin.dashboard.calendar.index', 'Evenimentul a fost actualizat cu succes!');
    }

    /**
     * Add an event to the calendar.
     *
     * @param \App\Models\Event $event
     * @return \Inertia\Response
     */
    public function addToCalendar(Event $event)
    {
        return $this->addEventToCalendar($event);
    }
}
