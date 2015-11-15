(function($){
    $('#status').change(function(){
        console.log('here');
        $(this).parents('form').submit();
    });
})(jQuery);