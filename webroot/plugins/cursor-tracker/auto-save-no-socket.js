function webSocketSetup(id, interval) {
    var csrfToken = $('[name=_csrfToken]').val();
        setInterval(function() {
            $.ajax({
                type: 'POST',
                url: id,
                data: $('form').serialize(),
                headers: {
                    Accept: "application/json"
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
                },
                success: function(result) {
                    console.log(result);
                }
            });
        }, interval);
}