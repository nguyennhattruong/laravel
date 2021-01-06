$(function () {
    var format = {
        format: 'DD-MM-YYYY'
    };

    var format_year = {
        format: 'YYYY'
    };

    var birthday = $("#date_of_birth");
    birthday.datetimepicker(format);
    birthday.find("input").datetimepicker(format);

    var id_date = $("#identity_card_date");
    id_date.datetimepicker(format);
    id_date.find("input").datetimepicker(format);

    var graduation_year = $("#graduation_year");
    graduation_year.datetimepicker(format_year);
    graduation_year.find("input").datetimepicker(format_year);

    var elements = {
        major_name: $('[name=major_name]'),
        major_code: $('[name=major_code]'),
        permanent_residence_city : $('[name=permanent_residence_city]'),
        permanent_residence_district : $('[name=permanent_residence_district]'),
        permanent_residence_code : $('[name=permanent_residence_code]'),
        school_10_name : $('[name=school_10_name]'),
        school_10_code : $('[name=school_10_code]'),
        school_11_name : $('[name=school_11_name]'),
        school_11_code : $('[name=school_11_code]'),
        school_12_name : $('[name=school_12_name]'),
        school_12_code : $('[name=school_12_code]'),
        area : $('[name=area]'),
        identity_card_place : $('[name=identity_card_place]'),
        place_of_birth_pulldown : $('[name=place_of_birth_pulldown]'),
        place_of_birth : $('[name=place_of_birth]'),
        fullname : $('[name=fullname]'),
        relative_full_name : $('[name=relative_full_name]'),
        cb10 : $('#cb-10'),
        cb11 : $('#cb-11'),
        print : $('#print')
    };

    elements.major_code.val(elements.major_name.val());
    elements.major_name.change(function (e) {
        elements.major_code.val($(this).val());
    });

    // Load district
    elements.permanent_residence_city.on('changed.bs.select', function (e) {
        loading_district(e.target.value);
    });

    elements.place_of_birth_pulldown.on('changed.bs.select', function (e) {
        elements.place_of_birth.val($(this).find('option:selected').text());
    });

    elements.permanent_residence_district.on('change', function (e) {
        if (elements.permanent_residence_district.val() !== null) {
            elements.permanent_residence_code.val(elements.permanent_residence_city.selectpicker('val') + elements.permanent_residence_district.val());
        }
    });

    function loading_district(code) {
        var html = '';
        $.ajax({
            url: site_path + '/admin/admissions/ajax_get_district_by_city/' + code,
            type: "get",
            beforeSend : function () {
                elements.permanent_residence_district.prop('disabled', true);
                elements.permanent_residence_district.empty();
                elements.permanent_residence_code.val('');
            },
            complete : function () {
                elements.permanent_residence_district.prop('disabled', false);
                if (elements.permanent_residence_district.val() !== null) {
                    elements.permanent_residence_code.val(elements.permanent_residence_city.selectpicker('val') + elements.permanent_residence_district.val());
                }

                elements.identity_card_place.val(elements.permanent_residence_city.find('option:selected').text());
            },
            success: function (result) {
                var json = JSON.parse(result);
                $.each(json, function(idx, obj) {
                    html += '<option value="' + obj.code + '">' + obj.name + '</option>';
                });
                elements.permanent_residence_district.html(html);
            }
        });
    }

    elements.school_10_name.on('changed.bs.select', function (e) {
        loading_school(e.target.value, elements.school_10_code, elements.school_10_name);
    });

    elements.school_10_code.on('change', function (e) {
        if ($(this).val().length !== 5) {
            elements.school_10_name.selectpicker('val', '');
            return true;
        }

        $.ajax({
            url: site_path + '/admin/admissions/ajax_get_high_school_by_code/' + $(this).val(),
            type: "get",
            success: function (result) {
                var json = JSON.parse(result);

                if (jQuery.isEmptyObject(json) === false) {
                    elements.school_10_name.selectpicker('val', json.id);
                } else {
                    elements.school_10_name.selectpicker('val', '');
                }
            }
        });
    });

    elements.school_11_name.on('changed.bs.select', function (e) {
        loading_school(e.target.value, elements.school_11_code, elements.school_11_name);
    });

    elements.school_11_code.on('change', function (e) {
        if ($(this).val().length !== 5) {
            elements.school_10_name.selectpicker('val', '');
            return true;
        }

        $.ajax({
            url: site_path + '/admin/admissions/ajax_get_high_school_by_code/' + $(this).val(),
            type: "get",
            success: function (result) {
                var json = JSON.parse(result);

                if (jQuery.isEmptyObject(json) === false) {
                    elements.school_11_name.selectpicker('val', json.id);
                } else {
                    elements.school_11_name.selectpicker('val', '');
                }
            }
        });
    });

    elements.school_12_name.on('changed.bs.select', function (e) {
        loading_school(e.target.value, elements.school_12_code, elements.school_12_name);

        if (elements.cb10.prop('checked')) {
            elements.school_10_name.selectpicker('val', e.target.value);
        }

        if (elements.cb11.prop('checked')) {
            elements.school_11_name.selectpicker('val', e.target.value);
        }
    });

    elements.school_12_code.on('change', function (e) {
        if ($(this).val().length !== 5) {
            elements.school_12_name.selectpicker('val', '');
            return true;
        }

        $.ajax({
            url: site_path + '/admin/admissions/ajax_get_high_school_by_code/' + $(this).val(),
            type: "get",
            success: function (result) {
                var json = JSON.parse(result);

                if (jQuery.isEmptyObject(json) === false) {
                    elements.school_12_name.selectpicker('val', json.id);
                } else {
                    elements.school_12_name.selectpicker('val', '');
                }
            }
        });
    });

    function loading_school(id, element_code, element_name) {
        $.ajax({
            url: site_path + '/admin/admissions/ajax_get_high_school/' + id,
            type: "get",
            beforeSend : function () {
                element_code.val('');
            },
            success: function (result) {
                var json = JSON.parse(result);

                if (element_name.selectpicker('val') !== null) {
                    element_code.val(json.code_city + json.code);

                    // Fill area
                    if (element_name.attr('name') === 'school_12_name') {
                        elements.area.val(json.area);
                    }
                }
            }
        });
    }

    elements.fullname.on('change', function (e) {
        if (elements.relative_full_name.val() === '') {
            elements.relative_full_name.val($(this).val());
        }
    });

    elements.print.on('click', function (e) {
        e.preventDefault();
        swal({
            text: "Vui lòng lưu trước khi in!",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((value) => {
            if (value) {
                window.open($(this).attr('href'), '_blank');
            }
        });
    });
});
