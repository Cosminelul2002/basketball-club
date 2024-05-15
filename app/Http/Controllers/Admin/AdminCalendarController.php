<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\Admin\AdminResourceTrait;
use Carbon\Carbon;
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
        $events = Event::all();

        $events->transform(function ($event) {
            $event->time = [
                'start' => Carbon::parse($event->start_time)->format('Y-m-d H:i'),
                'end' => Carbon::parse($event->end_time)->format('Y-m-d H:i'),
            ];
            $event->isEditable = true;
            return $event;
        });

        return Inertia::render('Admin/Calendar/Show', [
            'events' => $events,
        ]);
    }
}
