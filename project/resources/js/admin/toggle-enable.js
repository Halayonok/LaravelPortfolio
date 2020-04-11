$(document).ready(function () {
    $('.badge_toggle_enable').on('click', function (event) {
        event.preventDefault();

        let badge = $(this);

        let data = {
            'id': badge.data('modelId'),
            'model': badge.data('modelClass')
        };

        $.ajax({
            type: "POST",
            url: badge.data('action'),
            data: data,
            dataType: 'json',
            success: function (response) {
                badge.removeClass('badge-success')
                    .removeClass('badge-danger')
                    .addClass('badge-' + response.color)
                    .text(response.text);
            },
            error: function () {
                notifyError();
            }
        });
    });
});
