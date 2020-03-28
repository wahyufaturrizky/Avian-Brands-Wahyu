<div id="content"class="mr berita berita_pers" data-aos="fade">
		<div class="h-col fw bg-light-green">
			<div class="col-md-12">
				<div class="berita-featured">
					<!-- set carousel -->
					<h2 class="font-sofia-bold font-green font-md">Berita</h2>
					<div class="owl-carousel owl-theme oth-tentang-carousel">
	                    
				<?php foreach ($stickies as $stick): ?>
				<div class="bf-featured-col">
					<div class="bf-panel" >
                		<div class="item">
							<img src="<?= $stick['image_thumb'] ?>" alt="<?= $stick['title'] ?>"/>
							<div class="bf-panel-text">
								<h3 class="font-green font-md font-sofia-bold"><?= $stick['title'] ?></h3>						
								<p class="font-xs font-sofia-light"><?= date('d F Y', strtotime($stick['date'])) ." - ". $stick['title'] ?></p>

								<p class="text-right font-xs font-green">
									<a href="/articles/detail/<?= $stick['pretty_url'] ?>">Selanjutnya >></a>
								</p>
							</div>
						</div>
					</div>
				</div>
           		<?php endforeach; ?>
					</div>
				</div>
					
				
				<?php $i=0; ?>
				<?php if(count($models) > 0): foreach ($models as $model): ?>

				<?php if($i % 3 == 0){ ?>
				<div class="berita-col">
				<?php } ?>
					<div class="berita-panel">
						<img src="<?= $model['image_thumb'] ?>" alt="<?= $model['title'] ?>">
						<div class="berita-panel-text">
							<h3 class="font-green font-sm font-sofia-bold">
							<?= readmore($model['title'] , 50) ?></h3>						
								<p class="font-xs font-sofia-light"><?php echo dateformatonly_indonesia($model['date']) ?> - <?= ($model['short_content']) ? trimstr(strip_tags($model['short_content']), 40, 'WORDS', '...') : trimstr(strip_tags($model['full_content']), 40, 'WORDS', '...'); ?></p>

								<p class="text-right font-xs font-green">
									<a href="/articles/detail/<?= $model['pretty_url'] ?>">Selanjutnya >></a>
								</p>
						</div>
					</div>
				<?php if($i % 3 == 2 || $i == 2 ){ ?>
				</div>
				<?php } ?>


				<?php $i++; ?>	
				<?php endforeach; endif; ?>	

			</div>
		</div>
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<script type="text/javascript">
		$('.oth-tentang-carousel').owlCarousel({
	        loop:true,
	        margin:0,
	        dots:false,
	        responsive:{
	            0:{
	                items:1
	            },
	            600:{
	                items:1
	            },
	            1000:{
	                items:2
	            }
	        }
	    });
	</script>
<script type="text/javascript" src="/avian_new/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="/avian_new/js/jquery.matchHeight-min.js"></script>