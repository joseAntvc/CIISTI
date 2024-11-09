<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Status;
use App\Models\TypeEvent;
use App\Models\User;
use Illuminate\Http\Request;



class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('ciisti.events', compact('events'));
    }

    public function getModerators(int $id)
    {
        $event = Event::find($id);
        $user = User::where('id_rol', 3)->get();
        $moderatorNames = $event->moderators()->get();
        return view('components.form_moderator', compact('user', 'moderatorNames', 'event'));
    }

    public function updateModerators($eventId, Request $request)
    {
        // Validar que 'moderator_ids' sea un array de IDs de usuarios, permitiendo que esté vacío
        $validated = $request->validate([
            'moderator_ids' => 'array', // Permite un array vacío
            'moderator_ids.*' => 'exists:users,id', // Verifica que cada ID existe en la tabla 'users'
        ]);

        // Encontrar el evento
        $event = Event::findOrFail($eventId);

        // Si el array 'moderator_ids' está vacío, se eliminarán todos los moderadores
        $event->moderators()->sync($validated['moderator_ids'] ?? []);

        return response()->json([
            'message' => 'Moderadores actualizados con éxito.',
            'moderators' => $event->moderators // Retornar los nuevos moderadores asociados al evento si es necesario
        ]);
    }

    public function create()
    {
        $action = "create";
        $event = null;
        $locations = Location::all();
        $types = TypeEvent::all();
        $statuses = Status::all();

        return view('components.form_event', compact('action', 'event', 'locations', 'types', 'statuses'));
    }
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'date' => 'required|regex:/^\d{4}-\d{2}-\d{2}$/',
                'date_time' => 'required|regex:/^\d{2}:\d{2}$/',
                'location' => 'required|not_in:0',
                'type_event' => 'required|not_in:0',
                'status' => 'required|not_in:0',
            ], [
                'title.required' => 'Campo título es obligatorio.',
                'description.required' => 'Campo descripción es obligatorio.',
                'date.required' => 'Campo fecha es obligatorio.',
                'date.regex' => 'Campo fecha incorrecto. Debe tener el formato yyyy-mm-dd.',
                'date_time.required' => 'Campo horario es obligatorio.',
                'date_time.regex' => 'Campo hora incorrecto. Debe tener el formato hh:mm.',
                'location.not_in' => 'Campo ubicación es obligatorio.',
                'type_event.not_in' => 'Campo tipo de evento es obligatorio.',
                'status.not_in' => 'Campo estado es obligatorio.',
            ]);

            // Crear el evento en la base de datos
            $event = new Event();
            $event->title = $request->input('title');
            $event->description = $request->input('description');
            $event->date = $request->input('date');
            $event->date_time = $request->input('date_time');
            $event->comment =  $request->input('comment');
            $event->id_location = $request->input('location');
            $event->id_type_event = $request->input('type_event');
            $event->id_status = $request->input('status');
            $event->id_speaker = $request->input('speaker');
            $event->save();

            return response()->json(['message' => 'Evento registrado.'], 200);
        }
    }


    public function edit(int $id)
    {
        $action = "update";
        $locations = Location::all();
        $types = TypeEvent::all();
        $statuses = Status::all();
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Evento no encontrado.');
        }
        return view('components.form_event', compact('action', 'event', 'locations', 'types', 'statuses'));
    }

    public function destroy(int $id)
    {
        $event = Event::find($id);
        $event->moderators()->sync([]);
        $event->delete();

        return response()->json(['message' => 'Event eliminado.']);
    }

    public function update(Request $request, int $id)
    {
        $event = Event::find($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|regex:/^\d{4}-\d{2}-\d{2}$/',
            'date_time' => 'required|regex:/^\d{2}:\d{2}$/',
            'location' => 'required|not_in:0',
            'type_event' => 'required|not_in:0',
            'status' => 'required|not_in:0',
        ], [
            'title.required' => 'Campo título es obligatorio.',
            'description.required' => 'Campo descripción es obligatorio.',
            'date.required' => 'Campo fecha es obligatorio.',
            'date.regex' => 'Campo fecha incorrecto. Debe tener el formato yyyy-mm-dd.',
            'date_time.required' => 'Campo horario es obligatorio.',
            'date_time.regex' => 'Campo hora incorrecto. Debe tener el formato hh:mm.',
            'location.not_in' => 'Campo ubicación es obligatorio.',
            'type_event.not_in' => 'Campo tipo de evento es obligatorio.',
            'status.not_in' => 'Campo estado es obligatorio.',
        ]);

        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->date_time = $request->input('date_time');
        $event->comment =  $request->input('comment');
        $event->id_location = $request->input('location');
        $event->id_type_event = $request->input('type_event');
        $event->id_status = $request->input('status');
        $event->id_speaker = $request->input('speaker');
        $event->save();

        return response()->json(['message' => 'Datos actualizados.'], 200);
    }
}
