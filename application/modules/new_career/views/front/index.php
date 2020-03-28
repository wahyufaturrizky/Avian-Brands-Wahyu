
<!-- NEW UPDATE -->
<div id="content" class="mr horizontal-wrapper karir" data-aos="fade">
  <div class="h-col fw bg-light-green">
	<form action="<?= base_url() ?>new_career/Careers/filter_career" method="GET">
	<div class="col-md-12">
	  <div class="lamaran">
			<p class="font-sofia-bold font-green font-md">Lowongan Pekerjaan</p>
      <select class="select" title="Perusahaan" name="title">  
       	  <option value="Lowongan Pekerjaan Avian Group">PT Avia Avian</option>
       	  <option value="Kesempatan Berkarir di PT. Tirtakencana Tatawarna">PT Tirtakencana Tatawarna</option>
      </select>
      <select class="select" title="Kategori" name="position">
      <?php foreach ($position as $key): ?>
      	  <option value="<?= $key['position'] ?>"><?= $key['position'] ?></option>
      <?php endforeach ?>
      </select>
      <select class="select" title="Penempatan" name="location">
       <?php foreach ($location as $key): ?>
      	   <option value="<?= $key['location'] ?>"><?= $key['location'] ?></option>
       <?php endforeach ?>
      </select>
      <select class="select" title="Tipe" name="type_pekerjaan">
         <option value="pegawai_tetap">Pegawai Tetap</option>
	     <option value="mt">MT</option>
	     <option value="kontrak">Kontrak</option>
      </select>
      <!-- <input type="text" class="input-form" placeholder="Perusahaan"> -->
      <!-- <input type="text" class="input-form" placeholder="kategori">
      <input type="text" class="input-form" placeholder="penempatan">
      <input type="text" class="input-form" placeholder="Tipe"> -->
      <input type="text" name="created_at" onclick="$(this).attr({ type: 'date'});" class="input-form" placeholder="Tanggal terbit">
		  <button class="button button-rounded button-block btn-inline-green font-green" type="submit">Cari</button>
	  </div>
	  </form>
	  <?php if(count($models) > 0): foreach ($models as $model): ?>
	  <div class="karir-col nl">
		<h3 class="font-sm font-green font-sofia-bold">
			<span class="font-sofia-regular"><?= $model['title'] ?></span><br>
		</h3>
		<p class="font-xs font-green"><i class="fa fa-map-marker"></i>  <?= $model['location'] ?></p>
		<p class="font-sofia-bold font-xs"><?= $model['position'] ?></p>
		<p class="font-xs font-green font-sofia-light">Tersedia Sampai <span class="font-sofia-bold">31 Oktober 2019</span></p>
		<div class="karir-desc">
		<p class="font-sofia-light font-xs">
		  <?= $model['detail'] ?>
		</p>
		<p class="font-sofia-light font-xs">
		  <p><strong>Requirements:</strong></p>
		  <?= $model['requirement'] ?>
		</p>
		<p class="font-sofia-light font-xs">
		  <p><strong>Additional Info:</strong></p>
		  <?= $model['additional_info'] ?>
		</p>
		</div>
		<a href="<?= base_url() ?>karir/detail/<?= $model['id'] ?>">
		  <button class="btn-rounded button-block font-green font-sofia-light font-sm">Lihat Selengkapnya</button>
		</a>
	  </div>
	  <?php endforeach; else: ?>
	   <p class="career-nothing">Maaf untuk sementara tidak ada lowongan yang tersedia</p>
      <?php endif; ?>
			
	
    
		</div>
	</div>
</div>
<script type="text/javascript" src="/avian_new/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="/avian_new/js/jquery.matchHeight-min.js"></script>