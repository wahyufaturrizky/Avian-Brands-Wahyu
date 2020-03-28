<div id="content" class="mr produk_detail_produk bg-batik">
  <div class="row box0">
    <div class="row">
      <!-- card detail -->
      <div class="">
        <div class="col-md-4 card-detail text-left">
          <div class="row title">
            <div class="col-md-10 col-xs-6">
              <p class="font-sofia-bold font-sm font-green pdp-title"><?= $model['name'] ?></p>
            </div>
            <div class="col-md-2 col-xs-6">
              <i class="fa fa-heart-o"></i>
            </div>
          </div>
          <div class="detail-img text-left">
            <!-- <img src="/upload/product/viplas_1457692620.jpg" alt="<?= $model['name'] ?>"> -->
            <img src="<?= $model['image_url'] ?>" alt="<?= $model['name'] ?>">
          </div>
          <div class="desc-card">
            <dir class="row desc-produk text-left">
              <div class="col-md-7 col-xs-7"><p class="font-sofia-bold"><img class="img-icon" src="/avian_new/images/icon/mini-star.png"></i> Hasil Akhir</p></div>
              <div class="col-md-5 col-xs-5 font-sofia-light"><p class="font-sofia-light">Semi Gloss</p></div><br>
            </dir>
            <dir class="row desc-produk text-left">
              <div class="col-md-7 col-xs-7 font-sofia-bold"><p class="font-sofia-bold"><img class="img-icon" src="/avian_new/images/icon/mini-ruler.png">Daya sebar</p></div>
              <div class="col-md-5 col-xs-5 font-sofia-light"><p class="font-sofia-light">12 - 14 M<sup>2</sup>/L</p></div><br>
            </dir>
            <dir class="row desc-produk text-left">
              <div class="col-md-7 col-xs-7 font-sofia-bold"><p class="font-sofia-bold"><img class="img-icon" src="/avian_new/images/icon/mini-clock.png">Waktu pengeringan</p></div>
              <div class="col-md-5 col-xs-5 font-sofia-light"><p class="font-sofia-light">2-4 jam</p></div><br>
            </dir>
            <dir class="row desc-produk text-left">
              <div class="col-md-7 col-xs-7 font-sofia-bold"><p class="font-sofia-bold"><img class="img-icon" src="/avian_new/images/icon/mini-brush.png">Jumlah lapisan cat</p></div>
              <div class="col-md-5 col-xs-5 font-sofia-light"><p class="font-sofia-light">2 lapis</p></div><br>
            </dir>
            <div class="calculator-box">
              <p class="font-sofia-light text-center">Berapa banyak cat yang Anda butuhkan?<br>Hitung dengan kalkulator</p>
              <br>
              <button onclick="do_calculate()" class="btn btn-block font-sofia-bold font-sm font-green" type="button"><i class="fa fa-calculator"></i> Kalkulator</button>
            </div>
            <div class="other-button">
              <a href="#"><button class="btn btn-block font-sofia-bold font-sm font-green">Cari Toko Terdekat</button></a>



              <a href="/upload/product/files/<?= $model['filename'] ?>">
                <button class="btn btn-block font-sofia-bold font-sm font-green">Unduh file TDS</button>
              </a>
              <?php if ($model['file_url_msds']): ?>
              <a href="<?= $model['file_url_msds'] ?>"><button class="btn btn-block font-sofia-bold font-sm font-green">Unduh Informasi Keselamatan</button></a>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-8 desc">
        <div class="box-desc">
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green"><?= $model['name'] ?></span>
            <?= $model['description'] ?>
          </ul>



          <?php if ($model['usability_feature']): ?>
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green">Kegunaan dan keistimewaan</span>
            <?= $model['usability_feature'] ?>
          </ul>
          <?php endif ?>

          <?php if ($model['technical_data']): ?>
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green">Data Teknis</span>
            <?= $model['technical_data'] ?>
          </ul>
          <?php endif ?>

          <?php if ($model['surface_prep']): ?>
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green">Persiapan Permukaan</span>
            <?= $model['surface_prep'] ?>
          </ul>
          <?php endif ?>

          <?php if ($model['how_to_use']): ?>
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green">Cara Penggunaan</span>
            <?= $model['how_to_use'] ?>
          </ul>
          <?php endif ?>

          <?php if ($model['cleaning_tools']): ?>
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green">Persiapan Peralatan</span>
            <?= $model['cleaning_tools'] ?>
          </ul>
          <?php endif ?>

          <?php if ($model['how_to_store']): ?>
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green">Cara Simpan dan Penangannya</span>
            <?= $model['how_to_store'] ?>
          </ul>
          <?php endif ?>

          <?php if ($model['additional_information']): ?>
          <ul class="font-sofia-light font-sm">
            <span class="font-sofia-bold font-green">Info Lainnya</span>
            <?= $model['additional_information'] ?>
          </ul>
          <?php endif ?>
        </div>

        <div class="box-desc-color">
          <p class="font-sofia-bold font-green">Pilihan Warna<a href="<?= $color ?>">Lihat Warna Lainnya</a></p>

          <div class="color-slide ">
            <div class="cs-container">
                <div class="swiper-wrapper" id="another_color">
                  <!-- <div style="background-color: cyan" class="card-warna font-sofia-light swiper-slide">
                    <span>Guduk Abang</span>
                  </div> -->
                  <?php echo $result_color_list; ?>
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- /MAIN CONTENT -->

<!-- MODAL KALKULATOR YA-->
<div class="modal fade" id="area-iya" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="box-modal">
        <div class="row modal-ln1">
          <div class="col-md-12">
            <p class="font-sofia-light font-black text-center text-ln1">Berapa banyak cat yang saya butuhkan?</p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button></div>
        </div>
        <p class="font-sofia-bold font-sm font-black text-center">Anda tahu areanya?</p>
        <div class="row modal-ln2">
          <div class="col-md-6 col-xs-6">
            <button class="btn btn-block font-sofia-light font-black active" id="btn-iya">Ya</button>
          </div>
          <div class="col-md-6 col-xs-6">
            <button class="btn btn-block font-sofia-light font-black" id="btn-tidak">Tidak</button>
          </div>
        </div>
        <div class="modal-body">
          <p class="font-sofia-light font-black text-center">Masukkan ke kolom dibawah dan lihat berapa banyak yang anda butuhkan.</p>
          <div class="pad-form text-center">
            <form action="">
              <input class="form-control text-center" id="area" type="number" name="meter" placeholder="ukuran dalam satuan meter persegi">
            </form>
            <button id="btn-hitung1" class="btn-form btn-block font-sofia-light font-green font-sm">Hitung</button>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /MODAL -->

<!-- MODAL KALKULATOR TIDAK-->
<div class="modal fade" id="area-tidak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="box-modal">
        <div class="row modal-ln1">
          <div class="col-md-12">
            <p class="font-sofia-light font-black text-center text-ln1">Berapa banyak cat yang saya butuhkan?</p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button></div>
        </div>
        <p class="font-sofia-bold font-sm font-black text-center">Anda tahu areanya?</p>
        <div class="row modal-ln2">
          <div class="col-md-6 col-xs-6">
            <button id="btn-iya2" class="btn btn-block font-sofia-light font-black">Ya</button>
          </div>
          <div class="col-md-6 col-xs-6">
            <button id="btn-tidak2" class="btn btn-block font-sofia-light font-black active">Tidak</button>
          </div>
        </div>
        <!-- ya -->
        <div class="modal-body" id="modal-ya">
          <p class="font-sofia-light font-black text-center">Masukkan ke kolom dibawah dan lihat berapa banyak yang Anda butuhkan.</p>
          <form action="">
            <div class="row nol-padmarg marg-lef">
              <div class="col-md-5 col-xs-5 nol-padmarg">
                <input class="form-control text-center" type="number" id="height" name="meter" placeholder="Masukkan tinggi">
              </div>
              <div class="col-md-1 col-xs-2 nol-padmarg">
                <p class="font-sofia-light font-sm text-center font-x">x</p>
              </div>
              <div class="col-md-5 col-xs-5 nol-padmarg">
                <input class="form-control text-center" type="number" id="length" name="meter" placeholder="Masukkan panjang">
              </div>
            </div>
          </form>
          <div class="pad-form text-center">
            <button id="btn-hitung2" class="btn-form btn-block font-sofia-light font-green font-sm">Hitung</button>
          </div>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal-dialog -->

<div class="modal fade" id="area-output" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="box-modal">
        <div class="row modal-ln1">
          <div class="col-md-12">
            <p class="font-sofia-light font-black text-center text-ln1">Berapa banyak cat yang Anda butuhkan?</p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button></div>
        </div>
        <!-- ya -->
        <div class="modal-body" id="modal-ya">
          <p class="font-sofia-bold font-md font-green text-center text-output-modal"><?= $model['name'] ?></p>
          <div class="row desc-output">
            <div class="col-md-12 col-xs-12 font-sm">
              <p class="font-sofia-bold font-black text-center nol-padmarg">Luas area 
              </p>
              <p class="font-sofia-bold font-black text-center nol-padmarg">
                <span class="font-sofia-light font-md left-5px"> 
                  <span id="meter_here"></span> m<sup>2</sup>
                </span>
              </p>
              <br>
              <!-- <p class="font-sofia-light font-black text-center nol-padmarg">2 m x 7 m (panjang x tinggi)</p> -->
              <p class="font-sofia-bold font-black text-center nol-padmarg">Jumlah yang dibutuhkan </p>
              <p class="font-black text-center font-md" id="text-response">
                
              </p>
            </div>
            <br><br><br>
            <div class="col-xs-12 text-center">
              <p class="text-center font-sofia-light font-sm font-black">
                perkiraan ini berdasarkan cat. Derajat penutupan sebenarnya akan tergantung pada kondisi permukaan. Jika perubahan warnanya kontras, mungkin akan diperlukan lapisan tambahan.
              </p><br>
              <div class="boxbutton">
                <button onclick="do_calculate2()" class="btn-form btn-block font-sofia-light font-green font-sm recalc"><i class="fa fa-refresh"></i> Hitung ulang</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- CANNOT CALCULATE -->
<div class="modal fade" id="takbisa_dihitung" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="box-modal">
        <div class="row modal-ln1">
          <div class="col-md-12">
            <p class="font-sofia-light font-black text-center text-ln1">Berapa banyak cat yang saya butuhkan?</p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button></div>
        </div>
        <!-- ya -->
        <div class="modal-body" id="modal-ya">
          
          <div class="row desc-output text-center">
            <p class="text-center font-sofia-light font-black">
              Tidak Dapat di hitung dikarenakan produk ini tidak memiliki SPREAD_RATE
            </p><br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="boxbutton">
              <button data-dismiss="modal" class="btn-form btn-block font-sofia-light font-green font-sm"><i class="fa fa-refresh"></i> Tutup</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  
  $(document).ready(function($) {

  });

  $("#btn-hitung2").click(function() {
    
   $.ajax({
     url: '<?= base_url() ?>new_product/Product/hitung_produk',
     type: 'post',
     dataType: 'JSON',
     data: {
      pretty_url : "<?= $model['pretty_url'] ?>",
      tinggi     : $("#height").val(), 
      lebar      : $("#length").val(),
      type       : '2'
     },
     success: function(resp){
      response(resp);
     }
   });
   

  });

  $("#btn-hitung1").click(function() {
    
   $.ajax({
     url: '<?= base_url() ?>new_product/Product/hitung_produk',
     type: 'post',
     dataType: 'JSON',
     data: {
      pretty_url : "<?= $model['pretty_url'] ?>",
      luas      : $("#area").val(),
      type       : '1'
     },
     success: function(resp){
      response(resp);
     }
   });
   

  });

  function response(data){
    $("#text-response").html(data.text)
    $("#meter_here").html(data.total_area)
  }

  function do_calculate(){
    var spread_rate= "<?= $model['spread_rate'] ?>";
    if (spread_rate == null || spread_rate == "0" ) {
      $("#takbisa_dihitung").modal('show');
    } else {
      $("#area-iya").modal('show');
    }
  }

  function do_calculate2(){
    $("#area-output").modal('hide');
    $("#area-iya").modal('show');
  }


</script>