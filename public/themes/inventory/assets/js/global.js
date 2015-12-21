//$.validator.setDefaults({ ignore: ":hidden:not(.chosen)" });

$(document).ready(function () {
    $('.filter-item select, .chosen').chosen({
        width: 'auto'
    });

    $('.link-tooltip').tooltip();

    $('.create-transaction').validate({
        //validateNonVisibleFields: true,
        rules:{
            item_value: {
                min: 1,
                required: true
            },
            pawn_amount: {
                min: 1,
                max: 5,
                required: true
            },
            chosen: {
                required: true,
            }
        }
    });
});