// kalkulator modal
$(document).ready(function(){
	if($('body').find('.kantor-map').length > 0){
		$('.map-box').width($(window).width() - 100)
	}
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

	
	if ($(window).width() > 480) {
		$('body').find('.owl-stage-outer').addClass("not-hscroll");

		// Scroll Mousewheel
		$('html, body, *:not(.not-hscroll)').mousewheel(function(e, delta) {
			this.scrollLeft -= (delta * 200);
			e.preventDefault();
		});
	}

	//MatchHeight
	// $('.product-col').matchHeight();

	$('.btn-mfilter').on('click', function(){
		setTimeout(function(){
			$('.popover').toggleClass('margin-left');
		}, 10);
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

	var fg = $('.fourgroup');
	$("[data-toggle=popover]").on('shown.bs.popover', function () {
		$('.fgroup').each(function(){
			$(".title-group input[type=checkbox]").addClass('checkAll');
			var t = $(this),
				chk = t.find("input[type=checkbox]:not(.checkAll)"),
				chkt = t.find(".checkAll");
				chk.css('background', 'red');
				chkt.on("change",function(){
					if(this.checked){
						chk.prop('checked', $(this).prop('checked'));
						$(this).prop('checked', $(this).prop('checked'));
						this.setAttribute("checked","checked");
						chk.attr("checked","checked");
						// alert($('input[checked=checked').not('.checkAll').length);
					}else{
						chk.prop('checked', $(this).prop('checked'));
						this.removeAttribute("checked","checked");
						chk.removeAttr("checked","checked");
					}
				})
				chk.on('change', function(){
					if(this.checked){
						chkt.prop('checked', $(this).prop('checked'));
						chkt.attr("checked","checked");
					}else{
						setTimeout(function(){
							if($('input[checked=checked]:not(.checkAll)').length == 0){
								chkt.removeAttr("checked","checked");
							}
						}, 10);
						
					}
				})
		})

		$("input[type=checkbox]").each(function(){
			$(this).on("change",function(){
	            if(this.checked){
	                this.setAttribute("checked","checked");
	            }else{
	                this.removeAttribute("checked");
	            }
				$("#popoverContent").html($(".popover-content").html());
        	});
		})
	})
	$("[data-toggle=popover]").on('hidden.bs.popover', function () {
		$('.popover').toggleClass('margin-left');
	})

	$('.produk_detail .favorit').each(function(){
		var t = $(this),
				h = t.find('.fa-heart-o');
		t.click(function(){
			t.toggleClass('active');
		})
	})

	$('select.select').each(function() {
		$(this).selectpicker({
			style: 'select-control',
			size: 100
		});
	});

}); // end hoover background


