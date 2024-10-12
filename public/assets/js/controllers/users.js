var ventFrame;
function users(action, id) {
    var url = '/'+action;
    if (id) {
        url += '/'+id;
    }
    $.get(url, function(data) {
        ventFrame = $.dialog({
            title: '',
            columnClass: "col-6",
            content: data
        });
    });
}
