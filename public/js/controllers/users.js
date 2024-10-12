var ventFrame;
    function users(action, id) {
        var url = "{{ route('form') }}";
        if (id) {
            url += `/${id}`;
        }
        $.get(url, function(data) {
            ventFrame = $.dialog({
                title: '',
                columnClass: "col-6",
                content: data
            });
        });
    }
