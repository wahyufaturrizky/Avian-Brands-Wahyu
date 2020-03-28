<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<title>Avian Brands | <?= $header['title'] ?></title>
	<meta name="description" content="<?= $header['meta_desc'] ?>" />
    <meta name="keywords" content="<?= $header['meta_keys'] ?>" />
	<meta name="author" content="Avian Brands">
	<link rel="alternate" href="<?= base_url() ?>" hreflang="id-id" />
	<link rel="icon" href="/avian_new/images/favicon.png">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/style.css">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/responsive.css">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/aos.css">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/jssocials.css">

    <link rel="stylesheet" type="text/css" href="/avian_new/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="/avian_new/css/form-select.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
	<script type="text/javascript" src="/avian_new/js/jquery.js"></script>
</head>
<body class="bg-batik">
<!-- NAVBAR -->
<div id="navbar" class="bg-light-green font-green">
	<a href="<?= base_url() ?>">
	<img src="/avian_new/images/logo.png" id="logo">
	</a>
	<br>
	<div class="text-center">
		<img src="/avian_new/images/menu.png" class="nav-menu-icon">
	</div>
	<div class="col-md-6">
		<ul class="main-menu font-sofia-light font-sm">
			<li class="menu-parent">
				<a href="#">Tentang Kami</a>

				<ul class="menu-child font-sofia-light font-sm">
					<li>
						<a href="#">Avian Brands <i class="fa fa-chevron-down"></i></a>

						<ul class="menu-last-child text-left font-sofia-light font-sm">
							<li><a id="link-visimisi" href="<?= base_url() ?>vision">Visi, Misi & Nilai Perusahaan</a></li>
							<li><a id="link-sejarah" href="<?= base_url() ?>history">Sejarah</a></li>
							<li><a id="link-gedung" href="<?= base_url() ?>avian_tower">Gedung Avian Brands</a></li>
                  			<li><a id="link-aic" href="<?= base_url() ?>aic">Avian Inovation Center</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Pemasaran <i class="fa fa-chevron-down"></i></a>

						<ul class="menu-last-child text-left font-sofia-light font-sm">
							<li><a id="link-pemasaran" href="<?= base_url() ?>branch">Kantor Cabang</a></li>
							<li><a href="<?= base_url() ?>shop">Toko</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url('award') ?>">Sertifikasi</a>
					</li>
				</ul>
			</li>
			<li><a id="link-peduli" href="<?= base_url() ?>peduli">Avian Brands Peduli</a></li>
			<!-- <li><a href="produk.html">Produk</a></li> -->
			<li class="menu-parent">
              <a href="#">Produk</a>
               <ul class="menu-child font-sofia-light font-sm berita-menu warna-menu">
                <li><a id="link-produk-andalan" href="<?= base_url() ?>products">Produk Avian Brands</a></li>
                <li><a id="link-warna" href="<?= base_url() ?>color">Warna</a></li>
               </ul>
            </li>
			<li class="menu-parent">
				<a href="#">Berita</a>

				<ul class="menu-child font-sofia-light font-sm berita-menu">
					<li><a href="<?= base_url() ?>articles">Artikel</a></li>
					<li><a id="link-pers" href="<?= base_url() ?>pers">Siaran Pers</a></li>
				</ul>
			</li>
			<li><a id="link-peduli" href="<?= base_url() ?>karir">Karir</a></li>
			<!-- <li class="menu-parent">
				<a href="#">Karir</a>

				<ul class="menu-child font-sofia-light font-sm karir-menu">
					<li><a href="<?= base_url() ?>karir/avian">PT Avia Avian</a></li>
					<li><a href="<?= base_url() ?>karir/tirta">Tirtakencana Tatawarna</a></li>
				</ul>
			</li> -->
			<!-- <li class="menu-parent">
				<a href="#">Hubungan Investor</a>

				<ul class="menu-child font-sofia-light font-sm hubungan-menu">
					<li><a href="hi_tata_kelola.html">Tata Kelola Perusahaan</a></li>
					<li><a href="hi_pemegang_saham.html">Informasi Pemegang Saham</a></li>
					<li><a id="link-finansial" href="hi_finansial.html">Informasi Finansial</a></li>
				</ul>
			</li> -->
		</ul>
	</div>

	<div class="nav-bottom font-sm text-center">
		<input type="text" placeholder="Search" class="form-control input-sm"><br>
		<a href="#" class="fa fa-linkedin"></a>
		<a href="#" class="fa fa-youtube"></a>
		<a href="#" class="fa fa-facebook-square"></a>
		<a href="#" class="fa fa-instagram"></a>
	</div>
</div>
<div>
      <div id="gedung" class="push-right">
        <div class="hov-bg">
        </div> 
      </div> 
      <div id="aic" class="push-right">
        <div class="hov-bg">
        </div>
      </div> 
      <div id="warna" class="push-right">
        <div class="hov-bg">
        </div>
      </div> 
      <div id="pers" class="push-right">
        <div class="hov-bg">
        </div>
      </div> 
      <div id="andalan" class="push-right">
        <div class="hov-bg">
        </div>
      </div> 
      <div id="visimisi" class="push-right">
        <div class="hov-bg">
        </div>
      </div> 
      <div id="finansial" class="push-right">
        <div class="hov-bg">
        </div>
      </div>
      <div id="sejarah" class="push-right">
        <div class="hov-bg">
        </div>
      </div>
      <div id="pemasaran" class="push-right">
        <div class="hov-bg">
        </div>
      </div>
      <div id="sertifikasi" class="push-right">
        <div class="hov-bg">
        </div>
      </div>
      <div id="peduli" class="push-right">
        <div class="hov-bg">
        </div>
      </div>
      <div id="karir" class="push-right">
        <div class="hov-bg">
        </div>
      </div>
    </div>

<!-- NAVBAR-MOBILE -->
<div id="navbar-mobile" class="desktop-hide">
	<div id="nm-top" class="container-fluid bg-light-green">
			<div class="col-xs-3">
				<img src="/avian_new/images/menu.png" id="nm-trigger">
			</div>
			<div class="col-xs-6 text-center">
				<a href="<?php echo base_url() ?>"><img src="/avian_new/images/logo.png" id="logo"></a>
			</div>
			<div class="col-xs-3"></div>
	</div>
	<div id="nm-side" class="bg-batik">
		<ul class="mobile-menu font-lg font-green font-sofia-regular">
			<li class="menu-parent">
				<a href="#">Tentang Kami</a>

				<ul class="menu-child font-sofia-light font-sm">
					<li>
						<a href="#">Avian Brands <i class="fa fa-chevron-down"></i></a>

						<ul class="menu-last-child text-left font-sofia-light font-sm">
							<li><a id="link-visimisi" href="<?= base_url() ?>vision">Visi, Misi & Nilai Perusahaan</a></li>
							<li><a id="link-sejarah" href="<?= base_url() ?>history">Sejarah</a></li>
							<li><a id="link-gedung" href="<?= base_url() ?>avian_tower">Gedung Avian Brands</a></li>
                  			<li><a id="link-aic" href="<?= base_url() ?>aic">Avian Inovation Center</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Pemasaran <i class="fa fa-chevron-down"></i></a>

						<ul class="menu-last-child text-left font-sofia-light font-sm">
							<li><a id="link-pemasaran" href="<?= base_url() ?>branch">Kantor Cabang</a></li>
							<li><a href="<?= base_url() ?>shop">Toko</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url('award') ?>">Sertifikasi <i class="fa fa-chevron-down"></i></a>
					</li>
				</ul>
			</li>
			<li class="menu-parent"><a href="<?= base_url() ?>peduli">Avian Brands Peduli</a></li>
			<!-- <li><a href="produk.html">Produk</a></li> -->
			<li class="menu-parent">
              <a href="#">Produk</a>
               <ul class="menu-child font-sofia-light font-sm">
                <li><a id="link-produk-andalan" href="<?= base_url() ?>products">Produk Avian Brands</a></li>
                <li><a id="link-warna" href="<?= base_url() ?>color">Warna</a></li>
               </ul>
            </li>
			<li class="menu-parent">
				<a href="#">Berita</a>

				<ul class="menu-child font-sofia-light font-sm">
					<li><a href="<?= base_url() ?>news">Berita</a></li>
					<li><a href="<?= base_url() ?>articles">Artikel</a></li>
					<li><a id="link-pers" href="<?= base_url() ?>pers">Siaran Pers</a></li>
				</ul>
			</li>
			<li class="menu-parent">
				<a href="#">Karir</a>

				<ul class="menu-child font-sofia-light font-sm ">
					<li><a href="<?= base_url() ?>karir/avian">PT Avia Avian</a></li>
					<li><a href="<?= base_url() ?>karir/tirta">Tirtakencana Tatawarna</a></li>
				</ul>
			</li>
			<!-- <li class="menu-parent">
				<a href="#">Hubungan Investor</a>

				<ul class="menu-child font-sofia-light font-sm">
					<li><a href="hi_tata_kelola.html">Tata Kelola Perusahaan</a></li>
					<li><a href="hi_pemegang_saham.html">Informasi Pemegang Saham</a></li>
					<li><a id="link-finansial" href="hi_finansial.html">Informasi Finansial</a></li>
				</ul>
			</li> -->
		</ul>

		<div class="nms-bottom text-center">
			<input type="text" placeholder="Search" class="form-control input-sm"><br>
			<a href="#" class="fa fa-linkedin"></a>
			<a href="#" class="fa fa-youtube"></a>
			<a href="#" class="fa fa-facebook-square"></a>
			<a href="#" class="fa fa-instagram"></a>
		</div>
	</div>
</div>