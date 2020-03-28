        <div class="backtotop">
            <a href="#" class="btt"></a>
        </div>
        <div class="modal-contain" id="loading">
            <div class="modal-shade modal-shade-white"></div>
            <div class="modal-loading"></div>
        </div>
        <div class="modal-contain targetmess modal-fixed" id="popup">
            <div class="modal-shade"></div>
            <div class="modal-window modal-free">
                <div class="modal-content">
                    <div class="modal-close trigger" targid="mess"></div>
                    <div class="modal-title">

                    </div>
                    <div class="modal-text">

                    </div>
                </div>
            </div>
        </div>
        <div class="sitemap_contain">
            <div class="sitemap">
                <div class="logo-footer"></div>
                <div class="footer-sitemap">
                    <div class="footer-sitemap-group">
                        <div class="sitemap-group-title">Avian Brands</div>
                        <ul class="sitemap-group-items">
                            <li><a href="/about-us">Tentang Kami</a></li>
                            <li><a href="/csr">Avian Brands Peduli</a></li>
                            <li><a href="/awards">Penghargaan</a></li>
                            <li><a href="/contact-us">Hubungi Kami</a></li>
                            <li><a href="/career">Karir</a></li>
                            <?php if($total_faq > 0): ?>
                            <li><a href="/faq">FAQ</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="footer-sitemap-group">
                        <div class="sitemap-group-title">Ikuti Kami</div>
                        <ul class="sitemap-group-items sitemap-smicon">
                            <li><a title="Avian Brands Page" class="icon fb" target="_blank" href="https://www.facebook.com/AvianBrands/"><span class="fb"></span></a><div class="fb-like" data-href="https://www.facebook.com/AvianBrands/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div></li>
                            <li><a title="Avian Tube" class="icon yt" target="_blank" href="https://www.youtube.com/user/avianbrands"><span class="yt"></span></a>
                                <div class="div-youtube"><a target="_blank" href="https://www.youtube.com/subscription_center?add_user=avianbrands"><img src="/img/ui/ytb-25.png" alt="Youtube" /></a></div></li>
                            <li><a Title="Avian Linked In" class="icon in" target="_blank" href="https://www.linkedin.com/company/pt-avia-avian"><span class="in"></span></a><script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script><script type="IN/FollowCompany" data-id="6458791" data-counter="right"></script></li>
                            <li><a title="Avian Brands Instagram" class="icon ig" target="_blank" href="https://www.instagram.com/avianbrands"><span class="ig"></span></a><style>.ig-b- { display: inline-block; }
                .ig-b- img { visibility: hidden; }
                .ig-b-:hover { background-position: 0 -60px; } .ig-b-:active { background-position: 0 -120px; }
                .ig-b-v-24 { width: 137px; height: 24px; background: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24.png) no-repeat 0 0; }
                @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
                .ig-b-v-24 { background-image: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24@2x.png); background-size: 160px 178px; } }</style>
                <div class="div-ig"><a href="https://www.instagram.com/avianbrands/?ref=badge" class="ig-b- ig-b-v-24"><img src="//badges.instagram.com/static/images/ig-badge-view-24.png" alt="Instagram" /></a></div></li>
                        </ul>
                    </div>
                    <div class="lead"></div>
                </div>
                <div class="address-footer">
                    <p class="nama-pt">PT. AVIA AVIAN</p>
                    <p>Gedung Avian Brands</p>
                    <p>Jl. Ahmad Yani 317</p>
                    <p>Surabaya, Jawa Timur, 60234</p>
                    <p>P +6231 - 9984 3222 (hunting)</p>
                    <p>F +6231 - 9984 3311</p>
                </div>
            </div>
        </div>
        <div class="footerbar_contain">
            <div class="footerbar">
                <div class="footer_copyright">Hak Cipta &copy; 2019 Avian Brands. Semua Hak Milik.</div>
                <div class="footer_links">
                    <a href="/privacy">Kebijakan Privasi</a>
                    <span class="sep"></span>
                    <a href="/terms">Syarat &amp; Ketentuan</a>
                </div>
                <div class="lead"></div>
            </div>
        </div>
		<!-- END #MAIN PANEL -->

		<!-- #PLUGINS -->
        <script src="/js/front/plugins/jquery.js" type="text/javascript"></script>
        <script src="/js/front/plugins/excoloslider.js"></script>
        <script src="/js/front/plugins/masonry.js"></script>
        <script src="/js/front/plugins/jquery.custom-scrollbar.min.js"></script>
        <script src="/js/front/avian.js?ver=<?= VERSION ?>" type="text/javascript"></script>
        <link href="/css/front/style.css?ver=<?= VERSION ?>" rel="stylesheet" media="screen" />

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- MAIN APP JS FILE -->
        <?php
        //snippet for javascript or anything else that you want to put at the last line...
        if (isset($css)) {
            if (is_array($css)) {
                foreach($css as $value) {
                    echo '<link rel="stylesheet" href="'.$value. '?ver=' . VERSION .'" type="text/css"/>';
                }
            } else {
                echo '<link rel="stylesheet" href="'.$css. '?ver=' . VERSION . '" type="text/css"/>';
            }
        }
        ?>
        <?php
        //snippet for javascript or anything else that you want to put at the last line...
        if (isset($script_http)) {
            if (is_array($script_http)) {
                foreach($script_http as $value) {
                    echo '<script src="'.$value. '"></script>';
                }
            } else {
                echo '<script src="'.$script_http. '"></script>';
            }
        }
        ?>
        <?php
        //snippet for javascript or anything else that you want to put at the last line...
        if (isset($script)) {
            if (is_array($script)) {
                foreach($script as $value) {
                    echo '<script src="'.$value. '?ver=' . VERSION .'"></script>';
                }
            } else {
                echo '<script src="'.$script. '?ver=' . VERSION .'"></script>';
            }
        }
        ?>
        <?php
        //snippet for javascript or anything else that you want to put at the last line...
        if (isset($extra_script)) {
            if (is_array($extra_script)) {
                foreach($extra_script as $value) {
                    echo $value;
                }
            } else {
                echo $extra_script;
            }
        }
        ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0&appId=596785490489621&autoLogAppEvents=1';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

        <?= isset($snippet['footer']) ? $snippet['footer'] : "" ?>
    </body>
</html>
