<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Player;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = $request->get('searchQuery')
            ?
            Event::where('name', 'LIKE', '%' . $request->get('searchQuery') . '%')
            ->orderBy('created_at', 'DESC')
            ->with('teams')
            ->paginate(10)
            :
            Event::query()
            ->orderBy('created_at', 'DESC')
            ->with('teams')
            ->paginate(10);

        return Inertia::render('Events/List', [
            'events' => $events,
        ]);
    }

    public function edit(Event $event)
    {

        $event->load('teams');
        $event->teams->each(function ($team) {
            $team->load('players');
        });

        return Inertia::render('Events/Edit', [
            'event' => $event,
        ]);
    }

    public function create(Request $request)
    {
        $players = Player::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        return Inertia::render('Events/Create', [
            'players' => $players,
        ]);
    }

    public function store(EventRequest $request)
    {
        $event = Event::create($request->all());

        $teams = $request->get('teams');

        foreach ($teams as $team) {
            $event->teams()->create($team);
            $players = $team['players'];
            foreach ($players as $player) {
                $event->teams()->players()->create($player);
            }
        }

        return redirect()->route('events.index')->with('success', 'Event created.');
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
