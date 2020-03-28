<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Avian Brands | <?= $header['title'] ?></title>
    <meta name="description" content="<?= $header['meta_desc'] ?>" />
    <meta name="keywords" content="<?= $header['meta_keys'] ?>" />
	<meta name="author" content="Avian Brands">
	<link rel="alternate" href="<?= base_url() ?>" hreflang="id-id" />

	<?php if (isset($is_iphone) && $is_iphone): ?>
    <meta name="viewport" content="width=device-width, maximum-scale=1" />
	<?php else: ?>
    <meta name="viewport" content="width=device-width, maximum-scale=1" />
	<?php endif; ?>
    <link rel="icon" type="image/png" href="/img/ui/favicon.png" />

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:700' rel='stylesheet' type='text/css'>

    <!-- CSS and JS -->
    <link href="/css/font-awesome.min.css?ver=<?= VERSION ?>" rel="stylesheet" media="screen" />
    <link href="/css/front/avian.css?ver=<?= VERSION ?>" rel="stylesheet" media="screen" />
    <link href="/css/front/avian-mobile.css?ver=<?= VERSION ?>" rel="stylesheet" media="screen" />

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="/ico/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="/ico/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="/ico/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/ico/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="/ico/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="/ico/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="/ico/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="/ico/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="/ico/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="/ico/mstile-310x310.png" />
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/ico/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/ico/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/ico/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/ico/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/ico/apple-touch-icon-152x152.png" />

	<?= isset($snippet['header']) ? $snippet['header'] : "" ?>
</head>
<body>
    <div class="header_contain">
        <div class="header">
            <a href="/"><div class="logo"><h1 class="hidtxt">Avian Brands</h1></div></a>
            <div class="headernav">
                <?php if(isset($login_user['id'])): ?>
                    <a href="javascript:void(0)">Welcome, <?= $login_user['name'] ?></a>
                    <span class="hnavsep"></span>
                    <a href="/logout">Keluar</a>
                <?php else: ?>
                    <a href="/login">Masuk</a>
                    <span class="hnavsep"></span>
                    <a href="/register">Daftar</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="menubar_contain">
        <div class="menubar">
            <div class="main_nav target1a clearable">
                <div class="grub trigger" targid="1a"></div>
                <div class="navcontent">
					<div class="navitem">
                        <a class="nava navhome" href=""><span class="ico"></span><span class="txt">BERANDA</span></a>
                    </div>
                    <div class="navitem">
                        <a class="nava navprod" href="/product"><span class="ico"></span><span class="txt">PRODUK</span></a>
                    </div>
                    <div class="navitem">
                        <a class="nava navcarr" href="/store"><span class="ico"></span><span class="txt">TOKO</span></a>
                    </div>
					<div class="navitem navitem-wide">
                        <a class="nava navoff" href="/pemasaran"><span class="ico"></span><span class="txt">PEMASARAN</span></a>
                    </div>
					<div class="navitem navitem-wide">
                        <a class="nava navcont" href="/awards"><span class="ico"></span><span class="txt">PENGHARGAAN</span></a>
                    </div>
                    <div class="navitem">
                        <a class="nava navbea" href="https://beasiswajuara.kompas.id/" target="_blank"><span class="ico"></span><span class="txt">BEASISWA JUARA</span></a>
                    </div>
					<div class="navitem navitem-wide">
                        <a class="nava navcsr" href="/csr"><span class="ico"></span><span class="txt">AVIAN BRANDS PEDULI</span></a>
                    </div>
                </div>
            </div>
            <div class="search-main">
                <form method="POST" action="/search">
                    <input type="text" placeholder="Cari..." name="search" id="search"/>
                    <input type="submit"/>
                </form>
            </div>
        </div>
    </div>
