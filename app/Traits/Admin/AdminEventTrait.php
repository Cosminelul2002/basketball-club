<?php

namespace App\Traits\Admin;

trait AdminEventTrait
{
    public function addEventToCalendar($event)
    {
        $event->in_calendar = true;
        $event->save();

        return redirect()->route('admin.dashboard.calendar.index')->with('success', 'Evenimentul a fost adăugat cu succes în calendar!');
    }
}
