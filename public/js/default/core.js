$(document).ready(function (e) {

    // Overlay
    $('[data-coco=overlay]').each(function () {
        $(this).html('<div class="position-relative" style="z-index: 3">' + $(this).html() + '</div>');
        $(this).addClass($(this).data('class'));
        $(this).append('<div class="background-cover" style="filter: blur(' + $(this).data('blur') + 'px); background: url(' + $(this).data('image') + ') center bottom"></div>');
    });

    // NEO
    $('.neo a[href^="#"]').on('click', function (event) {
        var target = $($(this).attr('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 500);
        }
    });

    // data-scroll
    var scroll = function () {
        if ($(this).scrollTop() > 10) {
            $('[data-coco=scroll]').each(function () {
                $(this).addClass($(this).data('addclass'));
                $(this).removeClass($(this).data('removeclass'));
            });
        } else {
            $('[data-coco=scroll]').each(function () {
                $(this).removeClass($(this).data('addclass'));
                $(this).addClass($(this).data('removeclass'));
            });
        }
    };

    scroll();

    $(window).scroll(function () {
        scroll();
    });
});

$('.menu>li>a').each(function () {
    if ($(this).attr('href') + '/' === window.location.href
        || $(this).attr('href') === window.location.href) {
        $(this).addClass("homer");
        return false;
    }
});
