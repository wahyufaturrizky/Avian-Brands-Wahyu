var ColoursList = function () {
	var total_page_color = 0;
	var cur_page = 0;

	var gutter = 30;
	var min_width = 300;

	function check_load_more () {
		if (cur_page >= total_page_color) {
			$("#loadmore").hide();
		} else {
			$("#loadmore").show();
		}
	}

	return {

		init : function (page){
			total_page_color = page;

			var $container =  $('.griddscontent');

			if (page >= 1) cur_page = 1;

			check_load_more ();

			$('#loadmore').on( 'click', function() {
				cur_page++;
				$('#loading').addClass('active');

				$.ajax({
					type: "post",
					url: '/colours/loadmore-list',
					cache: false,
					data: {page: cur_page},
					dataType:'json',
					success: function(json) {
						$('#loading').removeClass('active');

						if (json.result == "NG") {
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}

						$.each( json.datas, function( key, data ) {

							var elems = '<div class="griddsitem gridcol width-2 height-3">' +
											'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ data.code +'" colid="'+ data.id +'" colexist="'+ data.is_like +'">' +
												'<div class="colourboxtint autopalette" colhex="'+ data.hex_code +'"></div>' +
												'<div class="colourboxcode">'+ data.code +'</div>' +
												'<div class="colourboxname">'+ data.name +'</div>' +
											'</div>' +
										'</div>';

							var $elems =	$(elems);

							$container.append($elems);
							$container.masonry( 'appended', $elems );

						});

						$('.autopalette').each(function(){
							colhex = $(this).attr('colhex');
							$(this).css({'background-color' : colhex});
						});
					},
					error: function() {
						$('#loading').removeClass('active');
						$('#popup .modal-title').html("Error !!!");
						$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
						$('#popup').addClass('active');
					}
				});

				// $('#loadmore').button('reset');

				check_load_more ();
			});

			$("#search-colour").keyup(function(event){
				if(event.keyCode == 13){
					$("#search-btn").click();
				}
			});

			$("#search-btn").click(function (){
				var search = $("#search-colour").val();

				if (search != "") {
					$('#loading').addClass('active');
					$.ajax({
						type: "post",
						url: '/colours/search',
						cache: false,
						data: {key: search},
						dataType:'json',
						success: function(json) {
							$('#loading').removeClass('active');
							if (json.result == "NG") {
								$('#popup .modal-title').html("Error !!!");
								$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
								$('#popup').addClass('active');
							}
							$container.masonry( 'remove', $container.find('.griddsitem') );
							$container.masonry();

							total_page_color = json.colours_page;
							cur_page = 1;

							check_load_more ();

							$.each( json.datas, function( key, data ) {

								var elems = '<div class="griddsitem gridcol width-2 height-3">' +
												'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ data.code +'" colid="'+ data.id +'" colexist="'+ data.is_like +'">' +
													'<div class="colourboxtint autopalette" colhex="'+ data.hex_code +'"></div>' +
													'<div class="colourboxcode">'+ data.code +'</div>' +
													'<div class="colourboxname">'+ data.name +'</div>' +
												'</div>' +
											'</div>';

								var $elems =	$(elems);

								$container.append($elems);
								$container.masonry( 'appended', $elems );

							});

							$('.autopalette').each(function(){
								colhex = $(this).attr('colhex');
								$(this).css({'background-color' : colhex});
							});
						},
						error: function() {
							$('#loading').removeClass('active');
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}
					});
				}
			});

			$("#clear-btn").click(function (){
				$("#search-colour").val("");
				$('#loading').addClass('active');

				$.ajax({
					type: "post",
					url: '/colours/clear-search',
					cache: false,
					dataType:'json',
					success: function(json) {
						$('#loading').removeClass('active');
						if (json.result == "NG") {
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}
						$container.masonry( 'remove', $container.find('.griddsitem') );
						$container.masonry();

						total_page_color = json.colours_page;
						cur_page = 1;

						check_load_more ();

						$.each( json.datas, function( key, data ) {

							var elems = '<div class="griddsitem gridcol width-2 height-3">' +
											'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ data.code +'" colid="'+ data.id +'" colexist="'+ data.is_like +'">' +
												'<div class="colourboxtint autopalette" colhex="'+ data.hex_code +'"></div>' +
												'<div class="colourboxcode">'+ data.code +'</div>' +
												'<div class="colourboxname">'+ data.name +'</div>' +
											'</div>' +
										'</div>';

							var $elems =	$(elems);

							$container.append($elems);
							$container.masonry( 'appended', $elems );

						});

						$('.autopalette').each(function(){
							colhex = $(this).attr('colhex');
							$(this).css({'background-color' : colhex});
						});
					},
					error: function() {
						$('#loading').removeClass('active');
						$('#popup .modal-title').html("Error !!!");
						$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
						$('#popup').addClass('active');
					}
				});

			});

			$(document).on("click",'.savelikebox', function(){
				var color = $(this).data("id");

				// console.log(color);

				likebox("color",color);
			});

			$(document).on("click",'.removelikebox', function(){
				var color = $(this).data("id");
				// console.log(color);
				likebox_remove("color",color);
			});

		}

	}


}();

var PaletteList = function () {


	var total_page_pallete = 0;
	var cur_page = 0;

	var gutter = 30;
	var min_width = 300;

	function check_load_more () {
		if (cur_page >= total_page_pallete) {
			$("#loadmore").hide();
		} else {
			$("#loadmore").show();
		}
	}

	return {

		init : function (page){
			total_page_pallete = page;

			var $container =  $('.griddscontent');

			if (page >= 1) cur_page = 1;

			check_load_more ();

			$('#loadmore').on( 'click', function() {
				cur_page++;
				$('#loading').addClass('active');

				$.ajax({
					type: "post",
					url: '/palette/loadmore-list',
					cache: false,
					data: {page: cur_page},
					dataType:'json',
					success: function(json) {
						$('#loading').removeClass('active');

						if (json.result == "NG") {
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}

						$.each( json.datas, function( key, data ) {
							var _elem = '<div class="griddsitem width-10 height-1 gridsep">' +
											'<h3 class="grid-section-title">'+ data.name +'</h3>' +
										'</div>';

							if (data.image_thumb) {
								_elem += '<div class="griddsitem gridcol width-2 height-3">' +
											'<a href="'+ data.image_url +'" class="colourbox trigger" data-lightbox="image-'+ data.id +'" data-title="'+ data.name +'">' +
												'<div class="colourboxcover">' +
													'<img src="'+ data.image_thumb +'" alt="'+ data.name +'" />' +
												'</div>' +
											'</a>' +
										'</div>';
							}

							$.each( data.pal_images, function( key, pal ) {
								_elem += '<div class="griddsitem gridcol width-2 height-3">' +
											'<a href="'+ pal.image_url +'" class="colourbox trigger" data-lightbox="image-'+ data.id +'" data-title="'+ data.name +'">' +
												'<div class="colourboxcover">' +
													'<img src="'+ pal.image_thumb +'" alt="'+ data.name +'" />' +
												'</div>' +
											'</a>' +
										'</div>';
							});

							var $_elem = $(_elem);

							$container.append($_elem);
							$container.masonry( 'appended', $_elem );

							$.each( data.colours, function( key, col ) {

								var elems = '<div class="griddsitem gridcol width-2 height-3">' +
												'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ col.code +'" colid="'+ col.id +'" colexist="'+ col.is_like +'">' +
													'<div class="colourboxtint autopalette" colhex="'+ col.hex_code +'"></div>' +
													'<div class="colourboxcode">'+ col.code +'</div>' +
													'<div class="colourboxname">'+ col.name +'</div>' +
												'</div>' +
											'</div>';

								var $elems =	$(elems);

								$container.append($elems);
								$container.masonry( 'appended', $elems );

							});

							if (data.colours.length > 0) {
								var elems = '<div class="griddsitem gridcol width-2 height-3">' +
												'<a href="/palette/detail/'+data.id+'" class="colourbox seemore">' +
													'<div><span>Lihat Semuanya</span></div>' +
												'</a>' +
											'</div>';
							}

							var $elems = $(elems);

							$container.append($elems);
							$container.masonry( 'appended', $elems );
						});

						$('.autopalette').each(function(){
							colhex = $(this).attr('colhex');
							$(this).css({'background-color' : colhex});
						});
					},
					error: function() {
						$('#loading').removeClass('active');
						$('#popup .modal-title').html("Error !!!");
						$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
						$('#popup').addClass('active');
					}
				});

				// $('#loadmore').button('reset');

				check_load_more ();
			});

			$("#search-palette").keyup(function(event){
				if(event.keyCode == 13){
					$("#search-btn").click();
				}
			});

			var filter = [];

			$("#search-btn").click(function (e){
				e.stopPropagation();
				e.preventDefault();

				var search = $("#search-palette").val();
				// var filter = [];


				// if ($('input[name="produk[]"]:checked').length != 0) {
					// $('input[name="produk[]"]:checked').each( function () {
						// filter.push($(this).val());
					// });
				// }

				if (search != ""){
					$('.clk_product').removeClass("active");
					filter = [];
				}

				if (search != "" || filter.length > 0) {
					$('#loading').addClass('active');
					$.ajax({
						type: "post",
						url: '/palette/search',
						cache: false,
						data: {key: search, filter: filter},
						dataType:'json',
						success: function(json) {
							$('#loading').removeClass('active');
							if (json.result == "NG") {
								$('#popup .modal-title').html("Error !!!");
								$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
								$('#popup').addClass('active');
							}

							$container.masonry( 'remove', $container.find('.griddsitem') );

							total_page_pallete = json.pallete_page;
							cur_page = 1;

							check_load_more ();

							$.each( json.datas, function( key, data ) {
								var _elem = '<div class="griddsitem width-10 height-1 gridsep">' +
												'<h3 class="grid-section-title">'+ data.name +'</h3>' +
											'</div>';

								if (data.image_thumb) {
									_elem += '<div class="griddsitem gridcol width-2 height-3">' +
												'<a href="'+ data.image_url +'" class="colourbox trigger" data-lightbox="image" data-title="'+ data.name +'">' +
													'<div class="colourboxcover">' +
														'<img src="'+ data.image_thumb +'" alt="'+ data.name +'" />' +
													'</div>' +
												'</a>' +
											'</div>';
								}

								$.each( data.pal_images, function( key, pal ) {
									_elem += '<div class="griddsitem gridcol width-2 height-3">' +
												'<a href="'+ pal.image_url +'" class="colourbox trigger" data-lightbox="image" data-title="'+ data.name +'">' +
													'<div class="colourboxcover">' +
														'<img src="'+ pal.image_thumb +'" alt="'+ data.name +'" />' +
													'</div>' +
												'</a>' +
											'</div>';
								});

								var $_elem = $(_elem);

								$container.append($_elem);
								$container.masonry( 'appended', $_elem );

								$.each( data.colours, function( key, col ) {

									var elems = '<div class="griddsitem gridcol width-2 height-3">' +
													'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ col.code +'" colid="'+ col.id +'" colexist="'+ col.is_like +'">' +
														'<div class="colourboxtint autopalette" colhex="'+ col.hex_code +'"></div>' +
														'<div class="colourboxcode">'+ col.code +'</div>' +
														'<div class="colourboxname">'+ col.name +'</div>' +
													'</div>' +
												'</div>';

									var $elems =	$(elems);

									$container.append($elems);
									$container.masonry( 'appended', $elems );

								});

								if (data.colours.length > 0) {
									var elems = '<div class="griddsitem gridcol width-2 height-3">' +
													'<a href="/palette/detail/'+data.id+'" class="colourbox seemore">' +
														'<div><span>Lihat Semuanya</span></div>' +
													'</a>' +
												'</div>';
								}

								var $elems = $(elems);

								$container.append($elems);
								$container.masonry( 'appended', $elems );
							});

							$container.masonry();

							$('.autopalette').each(function(){
								colhex = $(this).attr('colhex');
								$(this).css({'background-color' : colhex});
							});
						},
						error: function() {
							$('#loading').removeClass('active');
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}
					});
				}
			});

			$("#clear-btn").click(function (){
				$("#search-palette").val("");
				$('input[name="produk[]"]').removeAttr('checked');
				$('#loading').addClass('active');

				$('.clk_product').removeClass("active");
				filter = [];

				$.ajax({
					type: "post",
					url: '/palette/clear-search',
					cache: false,
					dataType:'json',
					success: function(json) {
						$('#loading').removeClass('active');
						if (json.result == "NG") {
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}
						$container.masonry( 'remove', $container.find('.griddsitem') );

						total_page_pallete = json.pallete_page;
						cur_page = 1;

						check_load_more ();

						$.each( json.datas, function( key, data ) {
							var _elem = '<div class="griddsitem width-10 height-1 gridsep">' +
											'<h3 class="grid-section-title">'+ data.name +'</h3>' +
										'</div>';

							if (data.image_thumb) {
								_elem += '<div class="griddsitem gridcol width-2 height-3">' +
											'<a href="'+ data.image_url +'" class="colourbox trigger" data-lightbox="image" data-title="'+ data.name +'">' +
												'<div class="colourboxcover">' +
													'<img src="'+ data.image_thumb +'" alt="'+ data.name +'" />' +
												'</div>' +
											'</a>' +
										'</div>';
							}

							$.each( data.pal_images, function( key, pal ) {
								_elem += '<div class="griddsitem gridcol width-2 height-3">' +
											'<a href="'+ pal.image_url +'" class="colourbox trigger" data-lightbox="image" data-title="'+ data.name +'">' +
												'<div class="colourboxcover">' +
													'<img src="'+ pal.image_thumb +'" alt="'+ data.name +'" />' +
												'</div>' +
											'</a>' +
										'</div>';
							});


							var $_elem = $(_elem);

							$container.append($_elem);
							$container.masonry( 'appended', $_elem );

							$.each( data.colours, function( key, col ) {

								var elems = '<div class="griddsitem gridcol width-2 height-3">' +
												'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ col.code +'" colid="'+ col.id +'" colexist="'+ col.is_like +'">' +
													'<div class="colourboxtint autopalette" colhex="'+ col.hex_code +'"></div>' +
													'<div class="colourboxcode">'+ col.code +'</div>' +
													'<div class="colourboxname">'+ col.name +'</div>' +
												'</div>' +
											'</div>';

								var $elems =	$(elems);

								$container.append($elems);
								$container.masonry( 'appended', $elems );

							});

							if (data.colours.length > 0) {
								var elems = '<div class="griddsitem gridcol width-2 height-3">' +
												'<a href="/palette/detail/'+data.id+'" class="colourbox seemore">' +
													'<div><span>Lihat Semuanya</span></div>' +
												'</a>' +
											'</div>';
							}

							var $elems = $(elems);

							$container.append($elems);
							$container.masonry( 'appended', $elems );
						});


						$container.masonry();

						$('.autopalette').each(function(){
							colhex = $(this).attr('colhex');
							$(this).css({'background-color' : colhex});
						});
					},
					error: function() {
						$('#loading').removeClass('active');
						$('#popup .modal-title').html("Error !!!");
						$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
						$('#popup').addClass('active');
					}
				});


			});

			$(document).on("click",'.savelikebox', function(){
				var color = $(this).data("id");

				likebox("color",color);
			});

			$(document).on("click",'.removelikebox', function(){
				var color = $(this).data("id");
				likebox_remove("color",color);
			});

			$('input[name="produk[]"]').change (function(){
				var filter = [];


				if ($('input[name="produk[]"]:checked').length != 0) {
					$('input[name="produk[]"]:checked').each( function () {
						filter.push($(this).val());
					});
				}

				if (filter.length > 0) {
					$("#search-btn").click();
				} else if (filter.length <= 0) {
					$("#clear-btn").click();
				}
			});

			$('.clk_product').click (function(){
				filter = [];

				$('.clk_product').removeClass("active");
				$(this).addClass("active");

				// if ($('input[name="produk[]"]:checked').length != 0) {
					// $('input[name="produk[]"]:checked').each( function () {
						filter.push($(this).data("id"));
					// });
				// }
				if (filter.length > 0) {
					$("#search-btn").click();
				} else if (filter.length <= 0) {
					$("#clear-btn").click();
				}
			});

		}

	}


}();

var PaletteDetail = function () {


	var total_page_color = 0;
	var cur_page = 0;

	var gutter = 30;
	var min_width = 300;

	function check_load_more () {
		if (cur_page >= total_page_color) {
			$("#loadmore").hide();
		} else {
			$("#loadmore").show();
		}
	}

	return {

		init : function (page,id){
			total_page_color = page;

			var $container =  $('.griddscontent');

			if (page >= 1) cur_page = 1;

			check_load_more ();

			$('#loadmore').on( 'click', function() {
				cur_page++;
				$('#loading').addClass('active');

				$.ajax({
					type: "post",
					url: '/palette/loadmore-detail',
					cache: false,
					data: {page: cur_page,id:id},
					dataType:'json',
					success: function(json) {
						$('#loading').removeClass('active');

						if (json.result == "NG") {
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}

						$.each( json.datas, function( key, data ) {

							var elems = '<div class="griddsitem gridcol width-2 height-3">' +
											'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ data.code +'" colid="'+ data.id +'" colexist="'+ data.is_like +'">' +
												'<div class="colourboxtint autopalette" colhex="'+ data.hex_code +'"></div>' +
												'<div class="colourboxcode">'+ data.code +'</div>' +
												'<div class="colourboxname">'+ data.name +'</div>' +
											'</div>' +
										'</div>';

							var $elems =	$(elems);

							$container.append($elems);
							$container.masonry( 'appended', $elems );

						});

						$('.autopalette').each(function(){
							colhex = $(this).attr('colhex');
							$(this).css({'background-color' : colhex});
						});
					},
					error: function() {
						$('#loading').removeClass('active');
						$('#popup .modal-title').html("Error !!!");
						$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
						$('#popup').addClass('active');
					}
				});

				// $('#loadmore').button('reset');

				check_load_more ();
			});

			$("#search-colour").keyup(function(event){
				if(event.keyCode == 13){
					$("#search-btn").click();
				}
			});

			$("#search-btn").click(function (){
				var search = $("#search-colour").val();

				if (search != "") {
					$('#loading').addClass('active');
					$.ajax({
						type: "post",
						url: '/palette/search-detail',
						cache: false,
						data: {key: search,id:id},
						dataType:'json',
						success: function(json) {
							$('#loading').removeClass('active');
							if (json.result == "NG") {
								$('#popup .modal-title').html("Error !!!");
								$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
								$('#popup').addClass('active');
							}
							$container.masonry( 'remove', $container.find('.griddsitem') );
							$container.masonry();

							total_page_color = json.colours_page;
							cur_page = 1;

							check_load_more ();

							$.each( json.datas, function( key, data ) {

								var elems = '<div class="griddsitem gridcol width-2 height-3">' +
												'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ data.code +'" colid="'+ data.id +'" colexist="'+ data.is_like +'">' +
													'<div class="colourboxtint autopalette" colhex="'+ data.hex_code +'"></div>' +
													'<div class="colourboxcode">'+ data.code +'</div>' +
													'<div class="colourboxname">'+ data.name +'</div>' +
												'</div>' +
											'</div>';

								var $elems =	$(elems);

								$container.append($elems);
								$container.masonry( 'appended', $elems );

							});

							$('.autopalette').each(function(){
								colhex = $(this).attr('colhex');
								$(this).css({'background-color' : colhex});
							});
						},
						error: function() {
							$('#loading').removeClass('active');
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}
					});
				}
			});

			$("#clear-btn").click(function (){
				$("#search-colour").val("");
				$('#loading').addClass('active');

				$.ajax({
					type: "post",
					url: '/palette/clear-search-detail',
					cache: false,
					dataType:'json',
					data: {id:id},
					success: function(json) {
						$('#loading').removeClass('active');
						if (json.result == "NG") {
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
							$('#popup').addClass('active');
						}
						$container.masonry( 'remove', $container.find('.griddsitem') );
						$container.masonry();

						total_page_color = json.colours_page;
						cur_page = 1;

						check_load_more ();

						$.each( json.datas, function( key, data ) {

							var elems = '<div class="griddsitem gridcol width-2 height-3">' +
											'<div class="colourbox trigger coltrigger" targid="colpop" colcode="'+ data.code +'" colid="'+ data.id +'" colexist="'+ data.is_like +'">' +
												'<div class="colourboxtint autopalette" colhex="'+ data.hex_code +'"></div>' +
												'<div class="colourboxcode">'+ data.code +'</div>' +
												'<div class="colourboxname">'+ data.name +'</div>' +
											'</div>' +
										'</div>';

							var $elems =	$(elems);

							$container.append($elems);
							$container.masonry( 'appended', $elems );

						});

						$('.autopalette').each(function(){
							colhex = $(this).attr('colhex');
							$(this).css({'background-color' : colhex});
						});
					},
					error: function() {
						$('#loading').removeClass('active');
						$('#popup .modal-title').html("Error !!!");
						$('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
						$('#popup').addClass('active');
					}
				});


			});

			$(document).on("click",'.savelikebox', function(){
				var color = $(this).data("id");

				likebox("color",color);
			});

			$(document).on("click",'.removelikebox', function(){
				var color = $(this).data("id");
				likebox_remove("color",color);
			});

		}

	}


}();

var CustomColor = function () {
	return {

		init : function (){
			$(document).on("click",'.savelikebox', function(){
				var r = $("#cmxs1").attr("val");
				var g = $("#cmxs2").attr("val");
				var b = $("#cmxs3").attr("val");

				var r_val = Math.round(r*2.55);
				var g_val = Math.round(g*2.55);
				var b_val = Math.round(b*2.55);

				// console.log("R: "+ r_val + " , G: " + g_val + " , B: " + b_val);

				//check if name is already entered
				var name = $("#color_name").val();
				if(name == "") {
					$('#popup .modal-title').html("Error !!!");
					$('#popup .modal-text').html('<p>Please Enter Colour Name.</p>');
					$('#popup').addClass('active');
				} else {
					$.ajax({
						type: "post",
						url: '/custom-colour/send',
						cache: false,
						data: {r: r_val, g:g_val , b:b_val, name: name},
						dataType:'json',
						success: function(json) {
							$('#loading').removeClass('active');
							if (json.is_error == true) {
								$('#popup .modal-title').html(json.data);
								if (json.data == "Please Login First to Save to Likebox.") $('#popup .modal-text').html('<p><button class="btn" type="button" onclick="location.href=\'/login\'">Go To Login</button></p>');
								else $('#popup .modal-text').html('');
								$('#popup').addClass('active');
							} else {
								$(this).data("id",json.id);
								likebox("custom_color",json.id);
							}

						},
						error: function() {
							$('#loading').removeClass('active');
							$('#popup .modal-title').html("Error !!!");
							$('#popup .modal-text').html('<p>Something Went Wrong.</p>');
							$('#popup').addClass('active');
						}
					});
				}
				// var color = $(this).data("id");

				// likebox("color",color);
			});

			$(document).on("click",'.removelikebox', function(){
				var color = $(this).data("id");
				likebox_remove("custom_color",color);
			});
		}
	}
}();
