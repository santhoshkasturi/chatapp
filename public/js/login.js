$(document).ready(function () {
    $('#login-form').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();

        $.ajax({
            url: url,
            type: method,
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.status == 'success') {
                    window.location.href = response.redirect;
                } else {
                    $('#login-error').text(response.message);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });
    });
});
