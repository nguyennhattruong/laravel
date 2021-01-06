// Global Config
var ckeditor_basic = {
    toolbar: [
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo'],
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Scayt']},
        {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
        {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},
        {name: 'tools', items: ['Maximize']},
        {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
        {name: 'others', items: ['-']},
        '/',
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {name: 'styles', items: ['Styles', 'Format']},
        {name: 'about', items: ['About']}
    ]
};

// Load
var elements_main = {
    'autonumeric': $("[data-coco=autonumeric]")
};

$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

var action;

// Buttons delete, trash, restore, update...
$("[data-coco=manage]").click(function (e) {
    action = $(this).data('coco-value');

    swal({
        text: "Are you sure you want to do this?",
        icon: "error",
        buttons: {
            cancel: true,
            confirm: true,
        },
    }).then((value) => {
        if (value) {
            form_submit($(this));
        }
    });
});

// Autonumeric
elements_main.autonumeric.each(function (index) {
    autonumeric($(this));
});

elements_main.autonumeric.keyup(function (e) {
    autonumeric($(this));
});

function autonumeric(that) {
    var numeric = that.val().replace(new RegExp(',', 'g'), '');
    that.val(numeric.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
}

// Confirm
function form_submit(that) {
    var form = that.closest('form');
    form.append('<input type="hidden" name="form_action" value="' + action + '">');
    form.submit();
}

$('.btn-group input[name="status"]').change(function () {
    $(this).closest('form').submit();
});

/* DatetimePicker */
var date = $(".date");
var date_format = {
    format: 'YYYY-MM-DD HH:mm',
    sideBySide: true,
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down"
    }
};

date.datetimepicker(date_format);
date.find("input").datetimepicker(date_format);

/*
|--------------------------------------------------------------------------
| Api
|--------------------------------------------------------------------------
*/
$("[data-coco=ajax]").click(function (e) {
    var that = $(this);
    var url = $(this).data('url');
    swal({
        text: "Bạn thực sự muốn thực hiện chức năng này?",
        icon: "warning",
        buttons: {
            cancel: true,
            confirm: true,
        },
    }).then((value) => {
        if (value) {
            $.ajax({
                type: "DELETE",
                url: url,
                success: function (data) {
                    if (data === '1') {
                        that.closest('tr').fadeOut('normal', function () {
                            that.closest('tr').remove();
                        });
                    } else {
                        popup_error();
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});

function popup_error() {
    swal({
        text: "Đã có lỗi xảy ra",
        icon: "error"
    });
}
