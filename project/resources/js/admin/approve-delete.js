$(document).ready(function () {

    $('.init_delete_model').on('click', function () {
        let btn = $(this);

        let action = btn.data('deleteAction');
        let title = btn.data('deleteTitle');

        $('#title_delete_model p').text(title);
        $('#approve_btn_delete').data('deleteAction', action);
    });

    $('#approve_btn_delete').on('click', function () {
        let btn = $(this);

        $.ajax({
            type: "POST",
            url: btn.data('deleteAction'),
            dataType: 'json',
            success: function (response) {
                $('#tr_model_'+ response.remove_model_id).remove();

                $('#title_delete_model p').text('');
                $('#approve_btn_delete').data('deleteAction', '');

                $('#delete_modal').modal('hide');

                notifySuccess(response.message);
            },
            error: function (xhr, status, err) {
                notifyError();
            }
        });
    });

});