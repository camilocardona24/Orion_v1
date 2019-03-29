var update_select = function () {
    if ($("#pizza").is(":checked")) {
        $('#pizza_kind').prop('disabled', false);
    }
    else {
        $('#pizza_kind').prop('disabled', 'disabled');
    }
};

$(update_select);
$("#pizza").change(update_select);

