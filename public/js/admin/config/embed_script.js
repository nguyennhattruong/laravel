$(document).ready(function () {
    $('.btn-add').click(function () {
        $('#main-script').append(html);
    });

    $(document).on('click', '.btn-delete', function () {
        $(this).closest('.col-md-12').fadeOut('fast', function () {
            $(this).remove();
        });
    });
});