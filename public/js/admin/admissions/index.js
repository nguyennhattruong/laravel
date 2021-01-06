$(function () {
    var birthday = {
        element: $("#date_of_birth"),
        json: {
            viewMode: 'years',
            format: 'YYYY'
        }
    };
    birthday.element.datetimepicker(birthday.json);
    birthday.element.find("input").datetimepicker(birthday.json);
});
