// kalkulator modal
$(document).ready(function(){
	// karir
	$(".box-lamaran").hide();
	$("#kirim-lamaran").click(function(){
		$(".box-lamaran").fadeIn(300);
	});
	$("#close-lamaran").click(function(){
		$(".box-lamaran").fadeOut(400);
	});


	// kalkulator
	$('#btn-tidak').click(function(){
		$('#area-iya').modal('hide');
		$('#area-tidak').modal('show');
		$('#navbar').css("display","block");
	});

	$('#btn-iya2').click(function(){
		$('#area-tidak').modal('hide');
		$('#area-iya').modal('show');
	});

	$('#btn-hitung1').click(function(){
		$('#area-iya').modal('hide');
		$('#area-output').modal('show');
	});

	$('#btn-hitung2').click(function(){
		$('#area-tidak').modal('hide');
		$('#area-output').modal('show');
	});

	// hover bg
	$('#link-gedung').mouseenter(function(){
		if ($("#gedung.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});


	$('#link-aic').mouseenter(function(){
		if ($("#aic.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-warna').mouseenter(function(){
		if ($("#warna.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-pers').mouseenter(function(){
		if ($("#pers.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-produk-andalan').mouseenter(function(){
		if ($("#andalan.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-visimisi').mouseenter(function(){
		if ($("#visimisi.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-finansial').mouseenter(function(){
		if ($("#finansial.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-sejarah').mouseenter(function(){
		if ($("#sejarah.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-pemasaran').mouseenter(function(){
		if ($("#pemasaran.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-sertifikasi').mouseenter(function(){
		if ($("#sertifikasi.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-peduli').mouseenter(function(){
		if ($("#peduli.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	$('#link-karir').mouseenter(function(){
		if ($("#karir.push-right").css("display", "block")) {
			$("#content").css("display", "none");
		}
		$(this).mouseleave(function(){
			if ($(".push-right").css("display", "none")) {
				$("#content").css("display", "block");
			}
		});
	});

	//Slider
	$('.slider').each(function(){
		var t = $(this),
			item = t.attr('data-items') ? t.attr('data-items') : 1,
			navs = t.attr('data-nav') && t.attr('data-nav')=="yes" ? true : false,
			centers = t.attr('data-center') && t.attr('data-center')=="yes" ? true : false,
			dot = t.attr('data-dot') && t.attr('data-dot')=="yes" ? true : false,
			auto = t.attr('data-auto') && t.attr('data-auto')=="no" ? false : true,
			loops = t.attr('data-loop') && t.attr('data-loop')=="no" ? false : true,
			aw = t.attr('data-width') && t.attr('data-width')=="fix" ? false : true,
			child = t.children().length;
		//console.log(child+" -"+item);
		if(child>=item){
			t.addClass('owl-carousel').each(function(){
				var t = $(this);
				t.owlCarousel({
					loop: loops,
					dots: dot,
					nav: navs,
					navText : ["<span class='prev'></span>","<span class='next'></span>"],
					autoplay: auto,
					autoplayTimeout: 4000,
					autoplaySpeed: 800,
					navSpeed: 800,
					dotsSpeed: 800,
					center: centers,
					autoHeight: true,
					// autoWidth: aw,
					items: 1
				})
			})
		}else{
			t.addClass('no-slider');

			$(window).resize(function(){res(t)});

		}

	   });

	// Scroll Mousewheel
	$('html, body, *').mousewheel(function(e, delta) {
		this.scrollLeft -= (delta * 200);
		e.preventDefault();
	});

	//MatchHeight
	$('.product-col').matchHeight();
	$('.btn-mfilter').on('click', function(){
		setTimeout(function(){
			$('.popover').toggleClass('margin-left');
		}, 50);
	});

	// All check
	$('.title-group').each(function() {
		var t = $(this),
				chk = t.find('.checkmark'),
				lc = t.siblings().find('input[type=checkbox]');
			t.click(function() {
				// lc.attr(checked);
				alert('addf')
			})
	})
	var tc = $(".title-group").find('.checkmark');

	$(document).on("change", ".fgroup .title-group input[type=checkbox]", function() {
		$(this).closest('li').addClass('parchecked');
		if($(this).is(":checked")){
			$('.parchecked').siblings('li').find("input[type=checkbox]").attr("checked", true);
		}else{
			$('.parchecked').siblings('li').find("input[type=checkbox]").attr("checked", false);
		}
	});

	$(document).on("change", ".fgroup input[type=checkbox]", function() {
		$(this).closest('li').addClass('checked')
		$('.checked').siblings('.title-group').find("input[type=checkbox]").attr("checked", true);
	});

}); // end hoover background


