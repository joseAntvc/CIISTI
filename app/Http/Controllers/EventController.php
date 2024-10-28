<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Status;
use App\Models\TypeEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::all();
        return view('ciisti.events', compact('events'));
    }
    public function create()
    {
        $action = "create";
        $event = null;
        $locations = Location::all();
        $types = TypeEvent::all();
        $statuses = Status::all();

    return view('components.formEvent', compact('action', 'event', 'locations', 'types', 'statuses'));
}

    public function edit(int $id)
    {
        $action = "update";
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Evento no encontrado.');
        }
        return view('components.formEvent', compact('action', 'event'));
    }
}
