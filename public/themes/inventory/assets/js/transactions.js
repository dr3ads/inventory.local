(function($){
    $('#status').change(function(){
        console.log('here');
        $(this).parents('form').submit();
    });
    $('#item_value').change(function(){
        var self = $(this);
        $('#pawn_amount').attr('max', self.val());
    });
})(jQuery);