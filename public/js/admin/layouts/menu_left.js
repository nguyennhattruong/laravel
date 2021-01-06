$(document).ready(function () {
    $('.menu-left .list-group-item a').each(function (index) {
        if (window.location.href.indexOf($(this).attr('href')) === 0) {
            $(this).closest('.collapse').addClass('show');
        }
    });
});
