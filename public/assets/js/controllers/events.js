function formEvent(id) {
    var url = '/events/';
    if (id) {
        url += id +'/edit/';
    } else {
        url += 'create'
    }
    $.get(url, function(data) {
        ventFrame = $.dialog({
            title: '',
            columnClass: "col-6",
            content: data
        });
    });
}


$(document).on('submit', '#eventForm', function(event) {
    event.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = form.serialize();

    $.ajax({
        url: url,
        method: method,
        data: formData,
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
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = '<ul>';
                $.each(errors, function(key, value) {
                    errorMessages += '<li>' + value[0] + '</li>';
                });
                errorMessages += '</ul>';

                $.alert({
                    title: 'Errores de Validación',
                    content: errorMessages,
                    type: 'red'
                });
            } else {
                $.alert({
                    title: 'Error',
                    content: 'Ocurrió un problema al procesar la solicitud.',
                    type: 'red'
                });
            }
        }
    });
});

function deleteEvent(id, title, type_Event){
    $.confirm({
        title: 'Deseas eliminar a',
        content: 'Evento: ' + title +" <br>Tipo de evento: " + type_Event,
        type: "red",
        columnclass: "col-6",
        buttons: {
            confirm: {
                text: 'Confirmar',
                btnClass: 'btn btn-delete-user-confirmar',
                action: function() {
                    $.ajax({
                        url: '/events/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            window.location.href = '/events';
                        },
                        error: function(xhr) {
                            $.alert({
                                title: 'Error',
                                content: 'No se pudo eliminar el evento. Por favor, intenta de nuevo.',
                                type: 'red'
                            });
                        }
                    });
                }
            },
            cancel: {
                text: 'Cancelar',
                btnClass: 'btn-red btn-delete-user-cancelar',
                action: function() {
                }
            }
        }
    });
}

function formModerator(id) {
    var url = '/events/' + id + '/moderators';
    $.get(url, function(data) {
        ventFrame = $.dialog({
            title: '',
            columnClass: "col-4",
            content: data
        });
    });
}
