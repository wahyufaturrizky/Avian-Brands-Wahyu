var _from = "";

var Article = function () {
	var total_page_article = 1;
	var cur_page = 1;

    var limit = 6;

	var gutter = 30;
	var min_width = 300;

	function check_load_more () {
		if (cur_page == total_page_article) {
			$("#loadmore").hide();
		} else {
            $("#loadmore").show();
        }
	}

    var load_article = function () {
        $.ajax({
            type: "post",
            url: '/article/loadmore',
            cache: false,
            data: {page: cur_page, limit:limit, from:_from },
            dataType:'json',
            success: function(json) {
                if (json.result == "NG") {
                    $('#popup .modal-title').html("Error !!!");
                    $('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
                    $('#popup').addClass('active');
                } else {
                    if (cur_page == 1) {
                        $("#article-container > .athird.athirdpictxt").remove();
                    }

                    $.each( json.datas, function( key, data ) {
                        var url = "/article/detail/";
                        if (data.type == "csr") {
                            url = "/article/detail/csr/";
                        }

                        var elems = '<div class="athird athirdpictxt" ><a href="'+ url + data.pretty_url +'">' +
                                        '<div class="athirdpic"><img src="'+ data.image_thumb +'" alt="'+ data.title +'"/></div>' +
                                        '<span class="athirdtitle">'+ data.title +'</span>' +
                                        '<span class="athirdtxt">'+ data.content_formated +'</span>' +
                                    '</a></div>';

                        $("#article-container > .lead").before(elems);

                    });

                    total_page_article = json.total_page;

    				check_load_more ();
                }

            },
            error: function() {
                $('#popup .modal-title').html("Error !!!");
                $('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
                $('#popup').addClass('active');
            }
        });
    };

	return {

		init : function (_limit = 6) {
			$("#loadmore").hide();

            limit = _limit;
            load_article();

			$('#loadmore').on( 'click', function() {
				cur_page++;
				load_article();
			});

		}

	}

}();

$(document).ready(function () {
    if ($("#article-container.home").length > 0) {
        _from = "home";
        Article.init(3);
    } else {
        _from = "list";
        Article.init(6);
    }
});
