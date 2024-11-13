@extends('layouts.navbar')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Eventos</h5>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <select id="filter" class="form-control custom-select me-4 mb-0">
                                <option value="0" {{ $idstatus == 0 ? 'selected' : '' }}>Todos</option>
                                <option value="1" {{ $idstatus == 1 ? 'selected' : '' }}>Programado</option>
                                <option value="2" {{ $idstatus == 2 ? 'selected' : '' }}>En curso</option>
                                <option value="3" {{ $idstatus == 3 ? 'selected' : '' }}>Finalizado</option>
                                <option value="4" {{ $idstatus == 4 ? 'selected' : '' }}>Cancelado</option>
                                <option value="5" {{ $idstatus == 5 ? 'selected' : '' }}>Pospuesto</option>
                            </select>
                            <a onclick="formEvent()" class="btn btn-sm mb-0 custom-button" type="button">+&nbsp;Agregar evento</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tblUsers">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Título
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Día
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hora
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Lugar
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tipo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Estatus
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0 azul">{{ $event->title }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $event->date }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $event->date_time }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $event->location->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $event->typeEvent->type_event}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $event->status->status}}</p>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="formEvent({{ $event->id }})" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit event">
                                                <i class="cursor-pointer fas fa-user-edit" style="color: #ffab3c"></i>
                                            </a>
                                                <a onclick="deleteEvent({{ $event->id }}, '{{ $event->title }}', '{{ $event->typeEvent->type_event }}')"
                                                    class="mx-2" data-bs-toggle="tooltip">
                                                    <i class="cursor-pointer fas fa-trash" style="color: #eb3f3f"></i>
                                                </a>
                                                <a onclick="formModerator({{ $event->id }})" id="moderators" class="mx-2" data-bs-toggle="tooltip" >
                                                    <i class="cursor-pointer fas fa-user-plus" style="color: blue"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Escucha los cambios en el filtro y redirige a la ruta correspondiente
        document.getElementById('filter').addEventListener('change', function() {
            const status = this.value;
            window.location.href = `/events/filter/${status}`;
        });
    </script>
@endsection
