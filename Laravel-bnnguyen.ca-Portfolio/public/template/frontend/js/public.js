$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


(function ($) {
    "use strict";

    $("#topRightNavClick").click(function(){
        if($("#topRightNav").hasClass("hidden")){
            $("#topRightNav").removeClass("hidden");
            $("#topRightNav").addClass("block");
        }else{
            $("#topRightNav").removeClass("block");
            $("#topRightNav").addClass("hidden");
        }
    });
})(jQuery);


