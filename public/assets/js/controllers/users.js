var ventFrame;
function formUser(id) {
    var url = '/users/';
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
