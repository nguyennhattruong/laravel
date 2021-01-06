$(document).ready(function () {
    $('.btn-add').click(function () {
        $('.meta-extension').append(html);
    });

    $(document).on('click', '.btn-delete', function () {
        $(this).closest('tr').fadeOut('fast', function () {
            $(this).remove();
        });
    });
});
