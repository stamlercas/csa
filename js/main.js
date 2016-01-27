$( document ).ready(function() {
    
    $('nav').slicknav();
    $('.slicknav_menu').prepend('<img style="max-width:70%;" src="../img/title.png" />');
    
    //fullscreen width
    var width= $(window).width();
    $('.homepage').css('width', width);
    //after everythings loaded
    $(window).resize(function() {
        var width= $(window).width();
        $('.homepage').css('width', width);
    });
    
    
    //Calculate the height of <header>
    //Use outerHeight() instead of height() if have padding
    var aboveHeight = $('header').outerHeight();

    //when scroll
    $(window).scroll(function(){

        //if scrolled down more than the header’s height
            if ($(window).scrollTop() > aboveHeight){

        // if yes, add “fixed” class to the <nav>
        // add padding top to the #content (value is same as the height of the nav)
            $('nav').addClass('fixed').css('top','0').next()
            .css('padding-top','60px');

            } else {

        // when scroll up or less than aboveHeight, remove the “fixed” class, and the padding-top
            $('nav').removeClass('fixed').next()
            .css('padding-top','0');
            }
        });
    
    
    //for slideshow on homepage
    var options = {
                $FillMode: 2,
                $AutoPlay: true,
                $DragOrientation: 1   //horizontal                            
            };

    var jssor_slider1 = new $JssorSlider$("slider1_container", options);
    
    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    function ScaleSlider() {
        var bodyWidth = document.body.clientWidth;
        if (bodyWidth)
            jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
        else
            $Jssor$.$Delay(ScaleSlider, 30);
    }

    ScaleSlider();
    $Jssor$.$AddEvent(window, "load", ScaleSlider);

    $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    //responsive code end

    
});
