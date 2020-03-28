<div id="content" class="mr">
    <?php  if ($sliders) { ?>
		<div class="slider" data-auto="yes" data-loop="yes" data-width="no" data-nav="yes">
	    <?php 
	    	for ($i=1; $i <8 ; $i++) {  
	    ?>
	    	<div class="home-bg hbg<?= $i ?>" style="background-image: url('/avian_new/newslider/<?= $i ?>.jpg');" data-img-mobile="/avian_new/newslider/device/<?= $i ?>.jpg">
	    		
	    	</div>
		<!-- <input type="hidden" id="hbg_no" value="<?= $i ?>"> -->
		<?php } ?>
		</div>
	<?php } ?>
  </div>
</div>
<script type="text/javascript" src="/avian_new/js/owl.carousel.min.js"></script>