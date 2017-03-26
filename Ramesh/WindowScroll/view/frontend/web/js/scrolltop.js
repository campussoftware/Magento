define(["jquery"],function($)
{
	$(window).scroll(function () {
       
        $("#current_window_top").val($(this).scrollTop());
        
        if ($(this).scrollTop() != 0) {
            $(".rameshscrolltop_div").show("fast");
        } else {
            $(".rameshscrolltop_div").hide();
        }
    });

    $(".rameshscrolltop_div").click(function () {
        var top = 0;
        if ($("#current_window_top").length > 0)
        {
            top =0;
            
        }
        $("body,html").animate({scrollTop: top}, 800);
    });
});