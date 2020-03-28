<div id="content" class="mr detail_karir bg-batik">
  <div class="box-containt">
    <div class="row dk-title">
      <div class="col-md-4 col-xs-12 ">
        <p class="font-sofia-bold font-md font-green text-left">
        <?php echo $model['title'] ?>
        </p>

        <p class="font-xs font-green"><i style="color: red" class="fa fa-map-marker"></i> Serpong</p>
        <p class="font-sofia-bold font-xs font-green">Tersedia sampai 41 Oktober 2019</p><br>
      </div>
    </div>
    <div class="row dk-content">
      <div class="col-md-4 col-xs-12">
        <p class="font-sofia-bold font-xs"><!-- Position Purpose: --></p>
        <p class="font-sofia-light font-xs">
           <p><strong>Position Purpose:</strong></p>
           <?php echo $model['position'] ?>
        </p>
      </div>
      <div class="col-md-4 col-xs-12">
        <p class="font-sofia-bold font-xs"></p>
        <p class="font-sofia-light font-xs">
            <?php echo $model['detail'] ?>
        </p>
      </div>
      <div class="col-md-4 col-xs-12">
        <p class="font-sofia-bold font-xs"></p>
        <p class="font-sofia-light font-xs">
          <p><strong>The Ideal Candidate should possess:</strong></p>
            <?php echo $model['requirement'] ?>
        </p>
      </div>
    </div>
  </div>
  <div class="box-lamaran-btn text-center">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-3 col-xs-12">
        <button id="kirim-lamaran" class="btn btn-outline-rounded font-sofia-bold font-sm font-green">Kirim Lamaran</button>
      </div>
      <div class="col-md-2 col-xs-12">
        <p class="font-sofia-bold font-sm font-green">Share: 
          <span class="pad-link">
            <a href="#" class="fa fa-linkedin"></a>
          </span>  
          <span class="pad-link">
            <a href="#" class="fa fa-facebook-square"></a>
          </span>
          <span class="pad-link">
            <a href="#" class="fa fa-whatsapp"></a>
          </span>
        </p>
      </div>
      <div class="col-md-1 col-xs-12"></div>
      <div class="col-md-1 col-xs-12">
        <a href="#" onclick="window.history.back()">
          <img width="25px" src="/avian_new/images/icon/back.png">
        </a>
      </div>
    </div>
  </div>
  <div class="box-lamaran">
    <div class="row">
      <div class="col-md-11 col-xs-12 pad-lamaran">
        <div class="mid">
          <p class="font-sofia-bold font-sm font-green">
            Daftarkan Diri Anda Sekarang!
          </p>
          <p class="font-sofia-light font-xs font-black">
            Informasi Anda akan tetap dalam database kami untuk sampai dengan 12 bulan sejak Anda memasukkan data. Setiap kali lowongan pekerjaan baru tersedia, tim kami akan mencari informasi di dalam database tersebut untuk diproses lebih lanjut. Semua informasi yang Anda berikan dijaga kerahasiaannya.
          </p><br>
          <form action="<?= base_url() ?>new_career/Careers/lamar/" method="post" enctype="multipart/form-data">
          <input type="text" name="nama" class="input-form" placeholder="Nama Lengkap"><br>
          <input type="text" name="date" class="input-form" placeholder="Tanggal Lahir" onclick="this.type='date'"><br>
          <input type="email" name="email" class="input-form" placeholder="Email"><br>
          <textarea name="tester" style="height: 33px;" class="input-form" placeholder="alamat"></textarea><br>
          <label class="label-fileup font-sofia-bold btn btn-outline-rounded btn-block"> Ungguh File <span class="font-sofia-light">(.PDF size max 4 MB)</span>
            <input style="display: none;" name="files" type="file" >
          </label>
          <!-- <input type="file" name="" style="display: none;" id="cv"> -->
          <!-- <button class="font-sofia-bold btn btn-outline-rounded btn-block btn-inline-green font-green" onclick="$('#cv').click()">Unggah File <span class="font-sofia-light">(.PDF size max 4 MB)</span></button> -->
          <button class="font-sofia-bold btn btn-outline-rounded btn-block btn-inline-green font-green" type="submit">Kirim</button>
          </form>
          <br><br>
          <p class="text-center font-sofia-bold font-sm font-green">Share: 
            <span class="pad-link">
              <a href="#" class="fa fa-linkedin"></a>
            </span>  
            <span class="pad-link">
              <a href="#" class="fa fa-facebook-square"></a>
            </span>
            <span class="pad-link">
              <a href="#" class="fa fa-whatsapp"></a>
            </span>
          </p>
        </div>
      </div>
      <div class="col-md-1 col-xs-12 cl">
        <a id="close-lamaran" href="#"><img width="30px;" src="/avian_new/images/icon/close.png"></a>
      </div>
    </div>
  </div>
</div>
<!-- /MAIN CONTENT -->
<script type="text/javascript" src="/avian_new/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="/avian_new/js/jquery.matchHeight-min.js"></script>