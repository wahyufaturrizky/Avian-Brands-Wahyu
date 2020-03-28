<!-- <div id="content" class="mr horizontal-wrapper produk" data-aos="fade">	
	<div class="h-col fw bg-light-green">
		<div class="col-md-12">
			


			<?php
                $i = 1;
                foreach ($pcategory as $model) :
            ?>

			<div class="product-col" >
				<img src="/avian_new/images/produk/page-produk<?= $i ?>.jpg">
				<h3 class="font-md font-sofia-bold head-text"><?= $model['name'] ?></h3>
				<p class="font-sofia-light font-sm"><?= $model['description'] ?></p>
				<a href="/products/detail/<?= $model['pretty_url'] ?>" class="button button-rounded button-block btn-inline-green font-green">Lihat Selengkapnya</a>
			</div>
			<?php $i++; ?>
			<?php
                endforeach;
            ?>

		</div>
	</div>
</div> -->
<div id="produk_andalan" class="mr horizontal-wrapper produk" data-aos="fade">
<div class="h-col fw bg-light-green pad-top">
		<div class="col-md-12">
			
			<?php
                $i = 1;
                foreach ($pcategory as $model) :
            ?>

			<div class="product-col" >
				<img src="/avian_new/images/produk/page-produk<?= $i ?>.jpg">
				<h3 class="font-md font-sofia-bold head-text"><?= $model['name'] ?></h3>
				<p class="font-sofia-light font-sm"><?= $model['description'] ?></p>
				<a href="/products/detail/<?= $model['pretty_url'] ?>" class="button button-rounded button-block btn-inline-green font-green">Lihat Selengkapnya</a>
			</div>
			<?php $i++; ?>
			<?php
                endforeach;
            ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="/avian_new/js/jquery.mousewheel.min.js"></script>
<!-- <script type="text/javascript" src="/avian_new/js/jquery.matchHeight-min.js"></script> -->