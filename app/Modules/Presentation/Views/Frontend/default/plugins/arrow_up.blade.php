<div id="arrow-up"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var arrowUp = $('#arrow-up');
        var scrollTop = function () {
            if ($(this).scrollTop() > 200) {
                arrowUp.fadeIn('fast');
            } else {
                arrowUp.fadeOut('fast');
            }
        };

        arrowUp.html('<span class="fa fa-chevron-up"></span>');
        arrowUp.bind("click", function () {
            $('body,html').animate({scrollTop: 0}, 500);
        });

        scrollTop();

        $(window).scroll(function () {
            scrollTop();
        });
    });
</script>
