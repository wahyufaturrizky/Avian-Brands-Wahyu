<div id="detail_warna" class="mr bg-batik detail_warna">
        <div class="row header nol-padmarg">
            <p class="font-sofia-light font-md font-green">
                Cat Tembok
            </p>   
        </div>
        <div class="row nol-padmarg">
            <div class="col-md-2 box-warna nol-padmarg">
                <div style="background-color: rgb( <?= $_GET['r'] ?>,<?= $_GET['g'] ?> ,<?= $_GET['b'] ?>)" class="card-warna font-sofia-light"><span class="circle-c" data-text="Lorem" ><?= $_GET['n'] ?></span></div>
            </div>
            <div class="col-md-5 box-card nol-padmarg">
                <div class="card-produk">
                    <div class="row nol-padmarg">
                        <div class="col-md-4 box-img-produk nol-padmarg">
                            <img class="cat-img" src="/avian_new/images/warna/Result_Produk.jpg">
                        </div>
                        <div class="col-md-8 box-desc-produk">
                            <p class="font-sofia-light font-green font-sm">Sunguard</p>
                            <p class="desc-content font-sofia-light font-xs font-black">
                                Lenkote Sunguard Acrylic Emulsion adalah cat bermutu tinggi yang dibuat dari 100% bahan superior acrylic yang diformulasikan untuk semua tembok luar baru atau sudah pernah di cat sebelumnya.
                                Lenkote Sunguard Acrylic Emulsion adalah cat bermutu tinggi yang dibuat dari 100% bahan superior acrylic yang diformulasikan untuk semua tembok luar baru atau sudah pernah di cat sebelumnya.
                            </p>
                            <button class="btn-produk font-sofia-bold font-green">Lihat produk</button>
                        </div>
                    </div>
                    <img class="shadow-img" src="/avian_new/images/icon/shadow.png">
                </div>
                <div class="card-produk">
                    <div class="row nol-padmarg">
                        <div class="col-md-4 box-img-produk nol-padmarg">
                            <img class="cat-img" src="/avian_new/images/warna/Result_Produk.jpg">
                        </div>
                        <div class="col-md-8 box-desc-produk">
                            <p class="font-sofia-light font-green font-sm">Sunguard</p>
                            <p class="desc-content font-sofia-light font-xs font-black">
                                Lenkote Sunguard Acrylic Emulsion adalah cat bermutu tinggi yang dibuat dari 100% bahan superior acrylic yang diformulasikan untuk semua.
                            </p>
                            <button class="btn-produk font-sofia-bold font-green">Lihat produk</button>
                        </div>
                    </div>
                    <img class="shadow-img" src="/avian_new/images/icon/shadow.png">
                </div>
                <div class="card-produk">
                    <div class="row nol-padmarg">
                        <div class="col-md-4 box-img-produk nol-padmarg">
                            <img class="cat-img" src="/avian_new/images/warna/Result_Produk.jpg">
                        </div>
                        <div class="col-md-8 box-desc-produk">
                            <p class="font-sofia-light font-green font-sm">Sunguard</p>
                            <p class="desc-content font-sofia-light font-xs font-black">
                                Lenkote Sunguard Acrylic Emulsion adalah cat bermutu tinggi yang dibuat dari 100% bahan superior acrylic yang diformulasikan untuk semua tembok luar baru atau sudah pernah di cat sebelumnya.
                            </p>
                            <button class="btn-produk font-sofia-bold font-green">Lihat produk</button>
                        </div>
                    </div>
                    <img class="shadow-img" src="/avian_new/images/icon/shadow.png">
                </div>
            </div>
            <div class="col-md-5 box-card nol-padmarg">
                <div class="card-produk">
                    <div class="row nol-padmarg">
                        <div class="col-md-4 box-img-produk nol-padmarg">
                            <img class="cat-img" src="/avian_new/images/warna/Result_Produk.jpg">
                        </div>
                        <div class="col-md-8 box-desc-produk">
                            <p class="font-sofia-light font-green font-sm">Sunguard</p>
                            <p class="desc-content font-sofia-light font-xs font-black">
                                Lenkote Sunguard Acrylic Emulsion adalah cat bermutu tinggi yang dibuat dari 100% bahan superior acrylic yang diformulasikan untuk semua tembok luar baru atau sudah pernah di cat sebelumnya.
                                Lenkote Sunguard Acrylic Emulsion adalah cat bermutu tinggi yang dibuat dari 100% bahan superior acrylic yang diformulasikan untuk semua tembok luar baru atau sudah pernah di cat sebelumnya.
                            </p>
                            <button data-text="Lihat produk" class="btn-produk font-sofia-bold font-green">Lihat produk</button>
                        </div>
                    </div>
                    <img class="shadow-img" src="/avian_new/images/icon/shadow.png">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function($) {
          
            $(".btn-produk").click(function() {
                
                window.location.href="<?= base_url() ?>products/items/sunguard";
            });

        });
    </script>