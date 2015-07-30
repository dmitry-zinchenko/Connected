/**
 * Created by Dmitry on 27.07.2015.
 */

$(window).scroll(function() {

    var scrolled = $(window).scrollTop();

    if ((scrolled > 50) && ($(window).width() > 767)) {
        // Navigation shadow and background
        $('.navbar-fixed-top').addClass('scrolled');
        // Heading image parallax
        $('.head-image').css('top', (300 - (scrolled - 50) * 0.5) + 'px');
    } else {
        $('.navbar-fixed-top').removeClass('scrolled');
        $('.head-image').css('top', '300px');
    }

});

$(document).ready(function() {

    $('a#learn-more').click(function(e) {
        e.preventDefault();
        var scrollTop = $(window).width() > 767 ? $('#description').offset().top - 70 : $('#description').offset().top;
        $('html, body').animate({
            scrollTop: scrollTop,
        }), 1500
    });


});