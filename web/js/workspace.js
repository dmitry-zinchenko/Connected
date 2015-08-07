/**
 * Created by Dmitry on 27.07.2015.
 */

var SHOWED = 'side-showed';
var HIDDEN = 'side-hidden';



$(document).ready(function() {

    var cookie = $.cookie('sidebar');
    if(!cookie) {
        $.cookie('sidebar', SHOWED, { expires : 30 });
        cookie = $.cookie('sidebar');
    }

    $('.sidebar').addClass(cookie);

    setSidebarHeight();

    if(cookie === SHOWED) {
        $('.content-work').css('width', ($(window).width() - $('.sidebar').width()) + 'px');
        $('.sidebar').css('display', 'block');
        $('.sidebar').css('right', 0);
    } else {
        $('.sidebar').css('display', 'none');
        $('.sidebar').css('right', '-' + $(".sidebar").width() + 'px');
    }

    if (window.innerWidth > 767) {

        $('.button-sidebar-open').on('click', function(event) {
            event.preventDefault();
            console.log('asdasf');

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
                $('.content-work').css('width', ($(window).width() - $('.sidebar').width()) + 'px');
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

            setNewNoticeButtonPosition();

        });

    } else {
        $('.sidebar').css('display', 'none');
        $('.content-work').css('width', '100%');
    }

    $(".members-list").customScrollbar({
        skin: "default-skin",
        hScroll: false,
        updateOnWindowResize: true,
        wheelSpeed: 30,
    });

    setNewNoticeButtonPosition();

    getChatMessages( { group: groupIdentifier, } );
    $('.sidebar').css('visibility', 'visible');
    setInterval(function() {
        getChatMessages( { group: groupIdentifier, } );
    }, 5000);

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

    $('.notice-body').each(function(index, obj) {
        if($(obj).height() == 100) {
            $(obj).append('<div class="shadow"></div>');
        }
    });

    function setCookie(state) {
        $.cookie('sidebar', state, { expires : 30 });
        cookie = $.cookie('sidebar');
    }

});

$(window).on('resize', function() {
    if(window.innerWidth > 767) {
        $('.sidebar').css('display', 'block');
        if(cookie === SHOWED) {
            $('.content-work').css('width', ($(window).width() - $('.sidebar').width()) + 'px');
        } else {
            $('.content-work').css('width', '100%');
        }
    } else {
        $('.sidebar').css('display', 'none');
        $('.content-work').css('width', '100%');
    }

    setSidebarHeight();
    setNewNoticeButtonPosition();

})

function setNewNoticeButtonPosition() {
    if($('.new-notice-buton').length){
        if(window.innerWidth > 767) {
            $('.new-notice-buton').css('left', ($('.notice-list').offset().left + $('.notice-list').width() - ($('.new-notice-buton').width() / 2)));
        } else {
            $('.new-notice-buton').css('left', ($('.notice-list').width() - ($('.new-notice-buton').width())));
        }
    }


}

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

function setSidebarHeight() {
    var sidebarHeight = $(window).height() - $('.navbar-dashboard').height();
    $('.sidebar').css('height', sidebarHeight);
}