//$.validator.setDefaults({ ignore: ":hidden:not(.chosen)" });



$(document).ready(function () {
    $('.filter-item select, .chosen').chosen({
        width: 'auto'
    });

    $('.date-picker').datepicker();

    $('.link-tooltip').tooltip();

    $('#hold-unli').change(function(){
        if(this.checked){
            $( "#void_at" ).datepicker( "destroy" );
            $('#void_at').addClass('disabled');
        }
        else{
            $( "#void_at" ).datepicker( );
            $('#void_at').removeClass('disabled');
        }
    });

    $('.go-print').click(function(){
        var ctrl = $(this).attr('data-id');
        printElement(document.getElementById('print-receipt-'+ctrl));
        window.print();
    });

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

