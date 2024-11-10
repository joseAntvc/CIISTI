<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/ciisti.css') }}" rel="stylesheet" />

    <title>Agregar Moderadores</title>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center text-center m-0 p-0">
        <div class="container-fluid py-3 m-0 p-0">
            <h5 class="custom-title mb-4">Agregar moderadores</h5>
            <form action="" method="POST" id="moderatorForm">
                @csrf
                <div class="col-md-9 mb-3 mx-auto">
                    <select class="select-moderator form-control-user-update" id="moderatorSelect">
                        <option value="" disabled selected>Seleccione un moderador</option>
                        @foreach ($user as $users)
                            @if ($users->id != 7)
                                <option value="{{ $users->id }}"
                                    data-name="{{ $users->name }} {{ $users->last_name }}">
                                    {{ $users->name }} {{ $users->last_name }}
                                </option>
                            @endif
                        @endforeach

                    </select>
                </div>

                <h5 class="custom-title mb-4">Moderadores seleccionados</h5>
                <div id="moderatorList"
                    class="d-flex flex-wrap gap-2 align-items-center justify-content-center text-center">
                    <!-- Moderadores ya guardados serán agregados aquí por JavaScript -->
                </div>

                <div class="col-md-9 mb-3 mx-auto justify-content-center text-center">
                    <button onclick="submitForm({{ $event->id }})" type="button"
                        style="background-color:rgb(4, 163, 86)"
                        class="btn btn-md mt-4 mb-2 text-white">Aceptar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function initializeModeratorForm() {
            // Variables y elementos
            let moderatorSelect = document.getElementById('moderatorSelect');
            let moderatorList = document.getElementById('moderatorList');

            // Moderadores existentes (asegúrate de que la variable `existingModerators` recibe los datos)
            let existingModerators = @json($moderatorNames);

            // Función para agregar moderador a la lista
            function addModerator(moderatorId, moderatorName) {
                if (moderatorList.querySelector(`[data-id="${moderatorId}"]`)) {
                    return;
                }

                let badge = document.createElement('div');
                badge.className = 'badge tag d-flex align-items-center gap-1';
                badge.setAttribute('data-id', moderatorId);

                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'moderator_ids[]';
                input.value = moderatorId;
                badge.appendChild(input);

                let nameText = document.createElement('span');
                nameText.textContent = moderatorName;
                badge.appendChild(nameText);

                let deleteIcon = document.createElement('i');
                deleteIcon.className = 'fas fa-times';
                deleteIcon.style.color = 'black';
                deleteIcon.onclick = () => badge.remove();
                badge.appendChild(deleteIcon);

                moderatorList.appendChild(badge);
            }

            // Inicializar moderadores existentes
            if (existingModerators && existingModerators.length > 0) {
                existingModerators.forEach(moderator => {
                    if (`${moderator.id}` != 7)
                        addModerator(moderator.id, `${moderator.name} ${moderator.last_name}`);
                });
            } else {

            }

            // Función para agregar moderador seleccionado
            function addSelectedModerator() {
                let selectedOption = moderatorSelect.options[moderatorSelect.selectedIndex];
                let moderatorId = selectedOption.value;
                let moderatorName = selectedOption.getAttribute('data-name');

                addModerator(moderatorId, moderatorName);
                moderatorSelect.selectedIndex = 0; // Resetear el select
            }

            // Escuchar cambios en el select para agregar moderador seleccionado
            moderatorSelect.addEventListener('change', addSelectedModerator);
        }

        // Llamar a la función al cargar el formulario
        setTimeout(function() {
            // Código a ejecutar después de un segundo
            initializeModeratorForm();
        }, 100);

        function updateModerators(eventId, moderatorIds) {
            $.ajax({
                url: '/events/' + eventId + '/update-moderators',
                method: 'POST',
                data: {
                    moderator_ids: moderatorIds,
                    _token: '{{ csrf_token() }}' // Incluye el token CSRF para la protección de formularios en Laravel
                },
                success: function(response) {
                    var successMessage = response.message;
                    ventFrame.close();
                    $.alert({
                        title: 'Éxito',
                        content: successMessage,
                        type: 'green',
                        onClose: function() {
                            window.location.href = '/events';
                        }
                    });
                },
                error: function(xhr) {
                    console.error('Error al actualizar moderadores:', xhr.responseText);
                }
            });
        }

        function submitForm(eventId) {
            // Obtén los IDs de los moderadores seleccionados del formulario
            const moderatorIds = Array.from(document.querySelectorAll('input[name="moderator_ids[]"]'))
                .map(input => input.value);

                finalModeratorIds = moderatorIds;
            //const finalModeratorIds = moderatorIds.length === 0 ? [7] : moderatorIds;

            // Llama a la función de actualización con los parámetros correctos
            updateModerators(eventId, finalModeratorIds);
        }


        document.getElementById("moderatorForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío del formulario
        });
    </script>

</body>

</html>
