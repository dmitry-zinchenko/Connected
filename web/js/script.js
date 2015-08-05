/**
 * Created by Dmitry on 27.07.2015.
 */

$(window).scroll(function() {

    var scrolled = $(window).scrollTop();

    if ((scrolled > 50) && (window.innerWidth > 767)) {
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
        var scrollTop = window.innerWidth > 767 ? $('#description').offset().top - 70 : $('#description').offset().top;
        $('html, body').animate({
            scrollTop: scrollTop,
        }), 1500
    });

    $('#delete-confirmation').on('click', function() {
        return confirm('This can not be undone, really. Are you sure?');
    })
});

$(document).ready(function() {

    var SHOWED = 'side-showed';
    var HIDDEN = 'side-hidden';

    var cookie = $.cookie('sidebar');
    if(!cookie) {
        $.cookie('sidebar', SHOWED, { expires : 30 });
        cookie = $.cookie('sidebar');
    }

    if (window.innerWidth > 767) {

        $('.sidebar').addClass(cookie);

        setSidebarHeight();

        if(cookie === SHOWED) {
            $('.content-work').css('width', (window.innerWidth - $('.sidebar').width()) + 'px');
            $('.sidebar').css('display', 'block');
            $('.sidebar').css('right', 0);
        } else {
            $('.sidebar').css('display', 'none');
            $('.sidebar').css('right', '-' + $(".sidebar").width() + 'px');
        }

        $('.button-sidebar-open').on('click', function(event) {
            event.preventDefault();

            if(cookie === SHOWED) {
                $('.content-work').css('width', '100%');
                $(".sidebar").animate(
                    {
                        right: '-' + $(".sidebar").width() + 'px'
                    }, 350, function() {
                        $('.sidebar').css('display', 'none');
                    }
                );
                $('.sidebar').removeClass(cookie);
                setCookie(HIDDEN);
                $('.sidebar').addClass(cookie);
            } else {
                $('.content-work').css('width', (window.innerWidth - $('.sidebar').width()) + 'px');
                $(".sidebar").css('display', 'block');
                $(".sidebar").animate(
                    {
                        right: '0'
                    },
                    350
                );
                $('.sidebar').removeClass(cookie);
                setCookie(SHOWED);
                $('.sidebar').addClass(cookie);
            }


        });

    } else {
        $('.sidebar').css('display', 'none');
    }

    function setCookie(state) {
        $.cookie('sidebar', state, { expires : 30 });
        cookie = $.cookie('sidebar');
    }

    function setSidebarHeight() {
        var sidebarHeight = $(window).height() - $('.navbar-dashboard').height();
        $('.sidebar').css('height', sidebarHeight);
    }

    $(window).on('resize', function() {
        if(window.innerWidth > 767) {
            $('.sidebar').css('display', 'block');
        } else {
            $('.sidebar').css('display', 'none');
        }
        if(cookie === SHOWED) {
            $('.content-work').css('width', (window.innerWidth - $('.sidebar').width()) + 'px');
        } else {
            $('.content-work').css('width', '100%');
        }
        var sidebarHeight = $(window).height() - $('.navbar-dashboard').height();
        $('.sidebar').css('height', sidebarHeight);
    })

    $(".members-list").customScrollbar({
        skin: "default-skin",
        hScroll: false,
        updateOnWindowResize: true,
        wheelSpeed: 30,
    });


});

$(document).ready(function() {

    getChatMessages(
        {
            group: 'qweqweqwe',
        }
    );

    function getChatMessages(params) {
        $.ajax({
            type: 'get',
            url: '/message',
            data: params,
            cache: false,
            response: 'json',
            success: function(response) {
                $.each(response.messages, function(index, value) {
                    console.log();
                    $('.group-chat').append(value.text + '<br>');
                })
                $(".group-chat").customScrollbar({
                    skin: "default-skin",
                    hScroll: false,
                    updateOnWindowResize: true,
                    wheelSpeed: 30,
                });


            },
            error: function(text) {
                alert('Caught Exception: ' + text);
            }
        });
    }

});