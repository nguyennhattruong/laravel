$(window).on('load', function () {
    var menu = $('.menu-mobile');
    menu.prepend('<div class="menu-fade"></div>');

    var fade = $('.menu-fade');
    var menuMain = $('.menu-main');
    var menuToggle = $('[data-coco=menu]');

    menuToggle.click(function () {
        fade.fadeIn('fast');
        menuMain.removeClass('menu-close').addClass('menu-open');
    });

    fade.click(function () {
        $(this).fadeOut('fast');
        menuMain.removeClass('menu-open').addClass('menu-close');
    });

    menuMain.click(function () {
        return true;
    });

    menu.on('click', '.fa-chevron-down', function () {
        $(this).removeClass('fa-chevron-down');
        $(this).addClass('fa-chevron-up');
    });

    menu.on('click', '.fa-chevron-up', function () {
        $(this).removeClass('fa-chevron-up');
        $(this).addClass('fa-chevron-down');
    });
});
