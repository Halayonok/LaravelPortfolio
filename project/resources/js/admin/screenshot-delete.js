$(document).ready(function () {

    $('.delete_screenshot').on('click', function (e) {
        e.preventDefault();

        let btn = $(this);

        $.ajax({
            type: "POST",
            url: btn.data('deleteAction'),
            dataType: 'json',
            success: function (response) {
                $('#screenshot_'+ response.remove_model_id).remove();

                notifySuccess(response.message);
            },
            error: function (xhr, status, err) {
                notifyError();
            }
        });
    });

});
