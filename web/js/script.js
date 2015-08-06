/**
 * Created by Dmitry on 27.07.2015.
 */

function scrollActions() {
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
}

$(window).scroll(function() {
    scrollActions();
});

$(document).ready(function() {

    scrollActions();

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

    if (window.innerWidth > 767) {

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

    getChatMessages( { group: groupIdentifier, } );
    $('.sidebar').css('visibility', 'visible');
    setInterval(function() {
        getChatMessages( { group: groupIdentifier, } );
    }, 5000);


    function getChatMessages(params) {
        $.ajax({
            type: 'get',
            url: baseUrl + '/message',
            data: params,
            cache: false,
            response: 'json',
            success: fillChat,
            error: function(text) {
                alert('Caught Exception: ' + text);
            }
        });
    }

    function fillChat (response) {
        var scrollToEnd = false;
        var top = parseInt($(".group-chat .overview").css('top'), 10) <= 0 ? parseInt($(".group-chat .overview").css('top'), 10) : null;
        if((top === null) || ($('#chat-form').attr('data') === 'submitted')) {
            scrollToEnd = true;
        }
        $('.group-chat').text('');
        $('#chat-form').removeAttr('data');
        $.each(response.messages, function(index, value) {
            var massageTime = getMessageTimeFromString(value.created_at);

            $('.group-chat').append(
                '<div class="message">' +
                    '<div class="message-info">' +
                        '<div class="message-autor">' + value.author + '</div>' +
                        '<div class="message-time">' + massageTime + '</div>' +
                    '</div>' +
                    '<div class="message-text">' + value.text + '</div>' +
                '</div>'
            );
        })
        $(".group-chat").customScrollbar({
            skin: "default-skin",
            hScroll: false,
            updateOnWindowResize: true,
            wheelSpeed: 30,
            animationSpeed: 0,
        });

        if(scrollToEnd) {
            $(".group-chat").customScrollbar("scrollByY", parseInt($(".group-chat .overview").css('height'), 10));
        } else {
            $(".group-chat").customScrollbar("scrollByY", -top);
        }
    }

    function getMessageTimeFromString(string) {
        var time = Date.parse(string);
        var datetime = new Date();
        datetime.setTime(time);

        var date = new Date(datetime.getFullYear(), datetime.getMonth(), datetime.getDate());

        var now = new Date();
        var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

        var massageTime = '';

        if(date.toDateString() === today.toDateString()) {
            massageTime =
                (datetime.getHours() < 10 ? '0' : '') + datetime.getHours() + ":" +
                (datetime.getMinutes() < 10 ? '0' : '') + datetime.getMinutes();
        } else {
            massageTime =
                (datetime.getDate() < 10 ? '0' : '') + datetime.getDate() + "-" +
                ((datetime.getMonth() + 1) < 10 ? '0' : '') + (datetime.getMonth() + 1) + "-" +
                datetime.getFullYear();
        }

        return massageTime;
    }

    function sendChatMessage(params) {
        $.ajax({
            type: 'post',
            url: baseUrl + '/message/send',
            data: params,
            cache: false,
            response: 'json',
            success: function() {
                getChatMessages( { group: groupIdentifier, } );
            },
            error: function(text) {
                alert('Caught Exception: ' + text.result);
            }
        });
    }

    $('.chat-message-input').keydown(function(event) {
        if (event.keyCode == 13) {
            $(this.form).submit();
            return false;
        }
    });

    $('#chat-form').on('submit', function(event) {
        event.preventDefault();
        $(this).attr('data', 'submitted');
        sendChatMessage(
            {
                group: groupIdentifier,
                text: $(this).children('.chat-message-input').val(),
            }
        );
        $(this).children('.chat-message-input').val('');
    });

});