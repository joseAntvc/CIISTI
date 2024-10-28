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
