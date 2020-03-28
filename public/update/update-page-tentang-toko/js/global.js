$(document).ready(function(){

	$("[data-toggle=popover]").popover({
        html : true,
        content: function() {
          var content = $(this).attr("data-popover-content");
          return $(content).html();
        }
    });

	getScrollPosition();
	getDeviceWidth();

	$(window).scroll(function(){
		getScrollPosition();
		getDeviceWidth();
	});

	var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });


	var view = false;

	$('#nav-trigger').click(function(){
		if (!view) {
			$('.navbar-right').addClass('active');
			view = true;
		}else{
			$('.navbar-right').removeClass('active');
			view = false;
		}
	});

	$("#share").jsSocials({
		showLabel: true,
		showCount: "inside",
		shares: ["facebook", "twitter",  "googleplus", "linkedin", "whatsapp",  "line"]
	});

	AOS.init({
		duration: 1000
	});

});

function getScrollPosition(){
	var w = $(window).width();
	if (w > 480) {
		var s = $(window).scrollTop();
		// alert(s);
	    if (s > $('.head').height()/3) {
	        $('#navbar').removeClass('navbar-transparent');
	        // alert('harusnya sih putih');
	    }else{
	        $('#navbar').addClass('navbar-transparent');
	        // alert('harusnya sih transparan');
	    };
	}
}

function getDeviceWidth(){
	var w = $(window).width();
	if (w <= 480) {
		$('#navbar').removeClass('navbar-transparent');
	}else{
		getScrollPosition();
	}
}

var sejarah_count = $('.sejarah-col').length;
// alert(sejarah_count);
var new_width = sejarah_count * ($('.sejarah-col').width() + 15);
$('.sejarah .h-col').width(new_width);

var award_count = $('.award-col').length;
// alert(sejarah_count);
if (award_count > 4) {
	var award_new_width = award_count * ($('.award-col').width() + 50);
	$('.award .h-col').width(award_new_width);
}

var product_count = $('.product-col').length;
if (product_count > 4) {
	var product_new_width = product_count  * ($('.product-col').outerWidth() + 20);
	$('.produk .h-col').width(product_new_width);
}

var cat_count = $('.cat-col').length;
// alert(sejarah_count);
if (cat_count > 2) {
	var cat_new_width = cat_count * ($('.cat-col').width() + 60);
	$('.cat .h-col').width(cat_new_width);
}

var berita_count = $('.berita-col').length;
if (berita_count > 1) {
	var berita_new_width = $('.berita-featured').width() + berita_count  * ($('.berita-col').width() + 50);
	$('.berita .h-col').width(berita_new_width);
}

var karir_count = $('.karir-col.nl').length;
if (karir_count > 1) {
	var karir_new_width = $('.lamaran').width() + karir_count  * ($('.karir-col.nl').width() + 80);
	$('.karir .h-col').width(karir_new_width);
}