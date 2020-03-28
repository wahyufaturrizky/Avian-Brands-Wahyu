var Product = function () {
	return {

		init : function (){
			$(document).on("click",'.savelikebox', function(){
				var prd = $(this).data("id");
				likebox("product",prd);
			});

			$(document).on("click",'.removelikebox', function(){
				var prd = $(this).data("id");
				likebox_remove("product",prd);
			});
		}
	}
}();

function rating_pengguna () {
	$(document).on("click", ".rating input", function (e) {
		e.stopPropagation();
    	e.preventDefault();

    	var inputValue = $(this).val();
    	var produkID = $('.produk_id').val();

    	$.ajax({
            type: "post",
            url: "/product/save-rating",
            cache: false,
            data: {rate: inputValue, produk_id: produkID},
            dataType:'json',
            beforeSend: function() {
                $('.loading-box').css("display", "block");
            },
            success: function(data) {
                $('.loading-box').css("display", "none");

                if (data.is_error == true) {
                	$('.rating').load(location.href+" .rating>*","");
                	swal("Error!", data.error_msg, "error");
                }
                else {
                	swal({
				        title: data.notif_title,
				        text: data.notif_message,
				        type: 'success',
				    }).then(function () {
				    	location.reload();
				    });
                }
            },
            error: function() {
                swal("Error!", "Something Went wrong", "error");
            }
        });
    });
}

function save_comment () {
    var form = $('#form-comment');
    var submit = $('#form-comment .btn-submit');

    $(form).validate( {
        errorClass      : 'invalid',
        errorElement    : 'em',

        highlight: function(element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },

        unhighlight: function(element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },

        // Rules for form validation
        rules: {
            comment : { required: true },
        },

        // Messages for form validation
        messages: {},

        // Ajax form submition.
        submitHandler: function(form) {
            $(form).ajaxSubmit( {
                dataType: 'json',
                beforeSend: function() {
                    $(submit).attr('disabled', true);
                    $('.loading').css("display", "block");
                },
                success: function(data) {
                    $('.loading-box').css("display", "none");

                    if (data.is_error == true) {
                        swal("Error!", data.error_msg, "error");
                    }
                    else {
                        swal({
                            title: data.notif_title,
                            text: data.notif_message,
                            type: 'success',
                        }).then(function () {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    $('.loading').css("display", "none");
                    $(submit).attr('disabled', false);
                    swal("Oops!", "Something went wrong.", "error");
                }
            });
        },
        // Do not change code below
        errorPlacement: function(error, element)
        {
            error.insertAfter(element);
        }
    });
}

function save_reply () {
    $(document).on('click', '.btn-reply', function () {
        var form = $(this).closest('form');
        var submit = $(this);

        $(form).validate( {
            errorClass      : 'invalid',
            errorElement    : 'em',

            highlight: function(element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },

            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },

            // Rules for form validation
            rules: {
                reply : { required: true },
            },

            // Messages for form validation
            messages: {},

            // Ajax form submition.
            submitHandler: function(form) {
                $(form).ajaxSubmit( {
                    dataType: 'json',
                    beforeSend: function() {
                        $(submit).attr('disabled', true);
                        $('.loading').css("display", "block");
                    },
                    success: function(data) {
                        $('.loading-box').css("display", "none");

                        if (data.is_error == true) {
                            swal("Error!", data.error_msg, "error");
                        }
                        else {
                            swal({
                                title: data.notif_title,
                                text: data.notif_message,
                                type: 'success',
                            }).then(function () {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        $('.loading').css("display", "none");
                        $(submit).attr('disabled', false);
                        swal("Oops!", "Something went wrong.", "error");
                    }
                });
            },
            // Do not change code below
            errorPlacement: function(error, element)
            {
                error.insertAfter(element);
            }
        });
    });
}

function save_review () {
    var form = $('#form-review');
    var submit = $('#form-review .btn-submit');

    $(form).validate( {
        errorClass      : 'invalid',
        errorElement    : 'em',

        highlight: function(element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },

        unhighlight: function(element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },

        // Rules for form validation
        rules: {
            comment : { required: true },
        },

        // Messages for form validation
        messages: {},

        // Ajax form submition.
        submitHandler: function(form) {
            $(form).ajaxSubmit( {
                dataType: 'json',
                beforeSend: function() {
                    $(submit).attr('disabled', true);
                    $('.loading').css("display", "block");
                },
                success: function(data) {
                    $('.loading-box').css("display", "none");

                    if (data.is_error == true) {
                        swal("Error!", data.error_msg, "error");
                    }
                    else {
                        swal({
                            title: data.notif_title,
                            text: data.notif_message,
                            type: 'success',
                        }).then(function () {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    $('.loading').css("display", "none");
                    $(submit).attr('disabled', false);
                    swal("Oops!", "Something went wrong.", "error");
                }
            });
        },
        // Do not change code below
        errorPlacement: function(error, element)
        {
            error.insertAfter(element);
        }
    });
}

function calc_cat () {
    $(document).on("click","#calcpopupbtn", function(event){
        event.stopPropagation();
		event.preventDefault();

		if( $(".calcpopup").hasClass("active") == false )
        {
            $('.clearable_sp').removeClass("active");
            $(".calcpopup").addClass("active");
        }
        else
        {
            $('.clearable_sp').removeClass("active");
            $(".calcpopup").removeClass("active");
        }

    });

    $(".closecalcpopup").click(function (){
        $(".calcpopup").removeClass("active");
    });

    $(".closehasilcalc").click(function (){
        $(".hasilcalc").removeClass("active");
    });



    $(".tpaintcalc").click(function () {
        var _h = $('#val-hei').val(),
            _w = $('#val-wid').val(),
            _s = $('#val-num').val();
        var _h_min = $('#val-hei-min').val(),
            _w_min = $('#val-wid-min').val(),
            _s_min = $('#val-num-min').val();

        var total_bidang = 0;
        var sprate = $(".calcpopup").data("sprate");
        var pack = $(".calcpopup").data("pack");
        var _unit = $(".calcpopup").data("unit");

        if (pack != null || pack != '') {
            pack = pack.split(";");
        }

        var _jumlah, _indexProduct;
        total_bidang = (_h * _w * _s) - (_h_min * _w_min * _s_min);
        _jumlah = total_bidang / sprate;
        _indexProduct = pack.length - 1;

        var _element = "-";

        if (pack.length > 0 && total_bidang > 0) {
            var _counter = 0;
            _element = "";
            while (_jumlah > 0) {
                //ukuran tanki
                var _tanki = parseFloat(pack[_indexProduct]);
                //selama jumlah - tanki, jumlah bisa dikurangi si tanki, dan brarti bisa pakai product ini.
                if ((_jumlah - _tanki) > 0) {
                    _counter++;
                    _jumlah -= _tanki;
                } else if ((_jumlah - _tanki) == 0) {
                    //pas 0, langsung cetak.
                    _counter++;
                    _jumlah -= _tanki;
                    //element to append jumlah tanki
                    _element += _counter + ' x ' + ' Kemasan ' + _tanki + ' ' + _unit;
                } else {
                    //apakah tidak ada ukuran tangki lain ?
                    if (_indexProduct == 0) {
                        //ukuran trakhir.
                        //apa boleh buat pake tangki ini.
                        _counter++;
                        _jumlah -= _tanki;
                        //element to append jumlah tanki
                        _element += _counter + ' x ' + ' Kemasan ' + _tanki + ' ' + _unit;
                    } else {
                        //ada product lain, cetak dulu yg sekarang.
                        if (_counter > 0) {
                            _element += _counter + ' x ' + ' Kemasan ' + _tanki + ' ' + _unit + ' <br /> ';
                        }
                        //turunin index. reset counter.
                        _counter = 0;
                        _indexProduct--;
                    }
                }
            }
        }

        $(".closecalcpopup").click();

        $("#total_bidang").html(total_bidang + " m<sup>2</sup> " );
        $("#hasilprodcalc").html(_element);

        $(".hasilcalc").addClass("active");
    });
}

$(document).ready(function () {
    Product.init();
    save_review();
    save_comment();
    save_reply();
    calc_cat ();
});

$(document).on("click", ".toggler_grouped_trigger", function () {
    var toggler_group = $(this).attr('data-toggler-group'),
        toggler_id = $(this).attr('data-toggler-id');
    if($(this).hasClass("active") == true){
        $('.toggler-'+toggler_group+'-'+toggler_id).removeClass("active");
    }else{
        $('.toggler-group-'+toggler_group).removeClass("active");
        $('.toggler-'+toggler_group+'-'+toggler_id).addClass("active");
    }
});

$(document).on("click", ".togglertab_grouped_trigger", function () {
    var togglertab_group = $(this).attr('data-togglertab-group'),
        togglertab_id = $(this).attr('data-togglertab-id');
    if($(this).hasClass("active") == false){
        $('.togglertab-group-'+togglertab_group).removeClass("active");
        $('.togglertab-'+togglertab_group+'-'+togglertab_id).addClass("active");
    }
});

$(document).on("click", ".toggler_popup_trigger", function (e) {
    e.stopPropagation();
    e.preventDefault();
    var toggler_id = $(this).attr('data-toggler-popup');
    if($(this).hasClass("active") == true){
        $('.toggler-'+toggler_id).removeClass("active");
    }else{
        $('.toggler-'+toggler_id).addClass("active");
    }
});

$(document).on("click", function () {
    $('.toggler_popup').removeClass("active");
});
