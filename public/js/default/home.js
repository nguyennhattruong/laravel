$(document).ready(function(){
    $('.div-pagination').removeClass('d-none');
    $('.div-pagination li:first-child').addClass('d-none');
    $('.div-pagination li:last-child').addClass('d-none');

    var sticky = $('header').height() - $('nav').height();
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > sticky) {
            $('nav').closest('section').addClass('sticky');
            $('#nar-mb').addClass('sticky');
        } else {
            $('nav').closest('section').removeClass('sticky');
            $('#nar-mb').removeClass('sticky');
        }
    });


    function getURLParameter(url, name) {
        return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
    }
    $('.div-pagination .page-link').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        if ($this.parent('li').hasClass('disable')) {
            return;
        }
        var path = APP_URL + '/api/products/get_list';
        var id = $this.closest('.div-pagination').attr('cat-id');
        var url = $(this).attr('href');

        if ($(this).children('i').length) {
            var current_url = $('#pagination-' + id).find('.active .page-link').attr('href');
            var current_page = getURLParameter(current_url, 'page');
            var url = path+'?id=' + id + '&page=' + (current_page - 1);
            $this.attr('href', url);
        }

        var page = getURLParameter(url, 'page');

        if (page != 1) {
            $('#pagination-' + id + ' li:first').removeClass('disabled disable')
        } else {
            $('#pagination-' + id + ' li:first').addClass('disable')
        }

        if (!id) {
            return;
        }

        $('#pagination-' + id).find('span.page-link').attr('href', path+'?id=' + id + '&page=1');

        // Call api
        $.ajax({
            type: "GET",
            url: path,
            data: {
                'id': id,
                'page': page,
            },
            beforeSend: function(){
                $("#loading").show();
            },
            complete: function(){
                $("#loading").hide();
            },
            success: function (result) {

                $('html, body').animate({
                    scrollTop: $('#slick-' + id).offset().top - 100
                }, 500);

                $('#slick-' + id).empty().html(result);
                $('#pagination-' + id).find('li.active').removeClass('active disabled disable');
                $this.closest('li').addClass('active disable');
            }
        });
    });


    // add cart

    $(document).on('click', '[data-coco=addCart]', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        toastr.options = {
            // "preventDuplicates": true,
            "timeOut": "3000",
            "positionClass": "toast-top-center",
        };
        toastr.success('Thêm vào giỏ hàng thành công!', 'Giỏ hàng');
        // Call api
        $.ajax({
            type: "POST",
            url: APP_URL + '/api/products/add_cart',
            data: {
                'id': id,
                'quantity': 1,
            },
            success: function (result) {

                $('#quantity_cart').text(result);
                console.log(result);
            }
        });
    });

});

// $(document).ready(function(e) {
//     $('#menu ul li').hover(
//         function(){
//             $(this).children('ul').stop().slideDown();
//         },
//         function(){
//             $(this).children('ul').css({'display':'none'});
//         }
//     );
// });
