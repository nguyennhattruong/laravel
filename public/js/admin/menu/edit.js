$(document).ready(function () {
    change();

    elements.select_onsite.on('change', function (event) {
        change();
    });

    elements.select_link_options.on('change', function () {
        if ($(this).val() === 'content' || $(this).val() === 'categories' || $(this).val() === 'neo' || $(this).val() === 'products_categories' || $(this).val() === 'page') {
            elements.panel_id_content_cate.show('normal');
        } else {
            elements.panel_id_content_cate.hide('normal');
        }
    });

    function change() {
        if (elements.select_onsite.val() === '1') {
            elements.panel_offpage.hide('normal');
            elements.panel_onpage.show('normal');
            elements.panel_id_content_cate.show('normal');

            if (elements.select_link_options.val() === 'content'
                || elements.select_link_options.val() === 'categories'
                || elements.select_link_options.val() === 'products_categories'
                || elements.select_link_options.val() === 'page'
                || elements.select_link_options.val() === 'neo') {
                elements.panel_id_content_cate.show('normal');
            } else {
                elements.panel_id_content_cate.hide('normal');
            }
        } else {
            elements.panel_offpage.show('normal');
            elements.panel_onpage.hide('normal');
            elements.panel_id_content_cate.hide('normal');
        }
    }
});
