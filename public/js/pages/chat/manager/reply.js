var unreadpoint_ajaxcall = 0;
var first_unread_point = 0;

$(document).ready(function() {
    create();
    if ($("#unreadpoint").length > 0) {
        $("#chat-body").animate({ scrollTop: $("#unreadpoint").offset().top  - $("#chat-body").offset().top  });

        first_unread_point = $("#unreadpoint").offset().top;
    }
    else {
        $("#chat-body").animate({ scrollTop: $("#chat-body > ul").height()  });
    }


    //done load, call ajax bikin jadi read semua
    $("#chat-body").scroll(function() {
        if ($("#unreadpoint").length > 0) {
            console.log($("#unreadpoint").offset().top);
            if ($("#unreadpoint").offset().top <= first_unread_point && unreadpoint_ajaxcall == 0) {

                unreadpoint_ajaxcall = 1;

                // call ajax set jadi read
                ajax_call ("POST", "/manager/chat/set-read", {room_id : $("#room_id").val()}, "chat_scroll");
            }
        }
    });


    $(document).on("form-submit:noredirect", function (e, form_id, data) {
        var message = $("#message").val();
        //hilangin messagenya
        $("#message").val("");

        //append si message kedalam si chat body
        var element_chat = '<li class="message myself">' +
                                '<div class="message-text">' +
                                    '<time>' +
                                        data.data.tanggal +
                                    '</time>' +
                                    '<a href="javascript:void(0);" class="username">Admin</a>' +
                                    data.data.message +
                                '</div>' +
                            '</li>';
        $("#chat-body").append (element_chat);

        // scroll si body
        $("#chat-body").animate({ scrollTop: $("#chat-body > ul").height() });

    });

});

var create = function (){
    //init validate form
    var create_form = "#create-form";
    var create_rules = {
        message: {
            required: true
        },
    };

    init_validate_form (create_form,create_rules);
}
