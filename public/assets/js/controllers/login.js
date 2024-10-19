$(document).on("submit", "#loginForm", function (event) {
    event.preventDefault();

    var form = $(this);
    var email = $("#email").val().trim();
    var password = $("#password").val().trim();
    var url = form.attr("action");
    var method = form.attr("method");

    if (!email || !password) {
        $.alert({
            title: "Campos Vacíos",
            content: "Por favor completa todos los campos vacíos",
            type: "orange",
        });
        return;
    }

    var formData = form.serialize();

    $.ajax({
        url: url,
        method: method,
        data: formData,
        success: function (response) {
            window.location.href = response.redirect_url;
        },
        error: function (xhr) {
            if (xhr.status === 422) {

                var message = xhr.responseJSON.message;

                $.alert({
                    title: "Error de Credenciales",
                    content: message,
                    type: "red",
                });
            } else {
                $.alert({
                    title: "Error",
                    content: "Ocurrió un problema al procesar la solicitud.",
                    type: "red",
                });
            }
        },
    });
});
