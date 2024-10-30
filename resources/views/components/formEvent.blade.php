<div class="d-flex justify-content-center align-items-center m-0 p-0">
    <div class="container-fluid py-3 m-0 p-0">
        <h5 class="custom-title mb-4">{{ $action == 'update' ? 'Actualización de evento' : 'Registro de evento' }}</h5>
        <form action="{{ $action == 'update' ? route('events.update', $event->id) : route('events.store') }}" method="POST" id="eventForm">
            @csrf
            @if($action == 'update')
                @method('PUT')
            @endif

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="title" class="form-control-label">Titulo</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="text" placeholder="Titulo" id="title" name="title" value="{{ old('title', $event ? $event->title : '') }}">
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="description" class="form-control-label">Descripción</label>
                    <textarea class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="textarea" placeholder="..." id="description" name="description">{{ old('description', $event ? $event->description : '') }}</textarea>
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto d-flex justify-content-between">
                <div class="form-user col-5">
                    <label for="date" class="form-control-labe col">Fecha</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="date" id="date" name="date" value="{{ old('date', $event ? $event->date : '') }}">
                </div>
                <div class="form-user col-5">
                    <label for="date_time" class="form-control-label">Horario</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="time" id="date_time" name="date_time" value="{{ old('date_time ', $event ? $event->date_time : '') }}">
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="location" class="form-control-label">Ubicación</label>
                    <select class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" id="location" name="location">
                        <option value="0">Selecciona un ubicación</option>
                        <option value="" disabled>──────────</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ ($event && $event->id_location == $location->id) ? 'selected' : '' }}> {{ $location->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="comment" class="form-control-label">Comentarios</label>
                    <textarea class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="textarea" placeholder="..." id="comment" name="comment">{{ old('comment', $event ? $event->comment : '') }}</textarea>
                </div>
            </div>
            <div class="col-md-9 mb-3 mx-auto d-flex justify-content-between">
                <div class="form-user col-5">
                    <label for="type_event" class="form-control-label">Tipo de evento</label>
                    <select class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" id="type_event" name="type_event">
                        <option value="0">Selecciona un tipo</option>
                        <option value="" disabled>──────────</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ ($event && $event->id_type_event == $type->id) ? 'selected' : '' }}>{{ $type->type_event }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-user col-5">
                    <label for="status" class="form-control-label">Estatus</label>
                    <select class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" id="status" name="status">
                        <option value="0">Selecciona un estatus</option>
                        <option value="" disabled>──────────</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ ($event && $event->id_status == $status->id) ? 'selected' : '' }}>{{ $status->status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input id="speaker" name="speaker" type="hidden" value="1">

            <div class="d-flex justify-content-center">
                <button id="submitEventForm"  type="submit" style="background-color: {{ $action == 'update' ?  '#ffab3c' : 'rgb(4, 163, 86)'}}"
                    class="btn btn-md mt-4 mb-2 text-white">{{ $action == 'update' ? 'Actualizar' : 'Registrar' }}</button>
            </div>
        </form>
    </div>
</div>
