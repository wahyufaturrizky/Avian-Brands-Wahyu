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

}); // end hoover background


