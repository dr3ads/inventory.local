$(document).ready(function () {
    $('.filter-item select, .chosen').chosen({
        width: 'auto'
    });
    $('.link-tooltip').tooltip();

    $('.create-transaction').validate({
        validateNonVisibleFields: true,
        rules:{
            item_value: {
                min: 1,
                required: true
            }
        }
    });
});