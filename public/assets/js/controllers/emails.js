var ventFrame;
function formEmail() {
    var url = '/email/form';
    $.get(url, function(data) {
        ventFrame = $.dialog({
            title: '',
            columnClass: "col-4",
            content: data
        });
    });
}

$(document).on('submit', '#emailForm', function(event) {
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
