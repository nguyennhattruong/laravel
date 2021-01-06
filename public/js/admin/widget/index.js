$(function () {
    var is_revert = false;

    $(".sortable").sortable({
        placeholder: "widget-item-old",
        revert: true,
        stop: function (event, ui) {
            // Update ordering
            update_ordering($(this));
        }
    });

    $(".draggable").draggable({
        connectToSortable: ".sortable",
        helper: "clone",
        revert: function (socketObj) {
            is_revert = socketObj === false;
        },
        start: function () {
            $('.ui-draggable-handle').css('width', '100%');
            $('.draggable-holder').addClass('draggable-holder-hover');
        },
        stop: function (event, ui) {
            $('.draggable-holder .ui-draggable-handle').css('width', '100%');
            $('.draggable-holder').removeClass('draggable-holder-hover');

            if (is_revert === false) {
                // Add widget
                var sortable = $(ui.helper[0]).closest('.sortable');
                var widget = $(this).data('widget');
                var description = $(this).data('widget-description');
                var position = sortable.data('widget');

                $.ajax({
                    type: "POST",
                    url: url_add,
                    data: {
                        'widget': widget,
                        'description': description,
                        'position': position
                    },
                    success: function (result) {
                        if (result.result === 1) {
                            // Add id for widget
                            $(ui.helper[0]).attr('id', result.id);
                            $(ui.helper[0]).find('[data-widget-action="delete"]').attr('data-widget-id', result.id);
                            $(ui.helper[0]).find('[data-widget-action="config"]').attr('data-widget-id', result.id);

                            // Display button config & delete
                            $(ui.helper[0]).find('div').removeClass('d-none');

                            // Update ordering
                            update_ordering(sortable);
                        }
                    }
                });
            }
        }
    });

    /**
     * Update ordering
     *
     * @param sortable
     */
    function update_ordering(sortable) {
        // Update ordering
        var data_update = [];
        var itemOrder = sortable.sortable("toArray");
        for (var i = 0; i < itemOrder.length; i++) {
            if (itemOrder[i] !== '') {
                data_update.push(parseInt(itemOrder[i]));
            }
        }

        $.ajax({
            type: "PUT",
            url: url_update,
            data: {
                type: 'update_ordering_batch',
                data: data_update.join(',')
            },
            success: function (result) {
                console.log(result);
            }
        });
    }
});


function delete_wid(that) {
    var id = $(that).data('widget-id');
    var item = $(that).closest('.widget-item');

    swal({
        text: "Are you sure you want to delete?",
        icon: "error",
        buttons: {
            cancel: true,
            confirm: true,
        },
    }).then((value) => {
        if (value) {
            $.ajax({
                type: "DELETE",
                url: site_path + '/admin/api/widgets/destroy/' + id,
                success: function (result) {
                    if (result === 1) {
                        swal({
                            title: "Successfully",
                            icon: "success",
                            timer: 1000
                        });

                        // Remove element
                        item.fadeOut('slow', function () {
                            item.remove();
                        });
                    }
                }
            });
        }
    });
}

function show_wid(that) {
    var id = $(that).data('widget-id');

    var modal = $('.modal');
    var modal_body = modal.find('.modal-body');
    modal_body.html('<iframe src="' + site_path + '/admin/widgets/' + id + '" frameborder="0" width="100%" style="height: calc(100vh - 180px)"></iframe>');
    modal.modal('show');
}

$('.modal').on('hidden.bs.modal', function (e) {
    location.reload();
});
