<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title> <?= $title . " | " . DEFAULT_TITLE_MANAGER ?> </title>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- #CSS Links -->
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/smartadmin-production.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/smartadmin-skins.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="/css/loading.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/animate.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/sweetalert.css">

        <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css">

        <!-- #GOOGLE FONT -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

        <!-- FAVICON -->
        <link rel="apple-touch-icon" sizes="152x152" href="/logo/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/logo/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/logo/favicon-16x16.png">
        <link rel="manifest" href="/logo/manifest.json">
        <link rel="mask-icon" href="/logo/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/logo/favicon.ico">
        <meta name="msapplication-config" content="/logo/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

    </head>
    <body class="smart-style-2">

		<!-- #HEADER -->
		<header id="header">
			<div id="logo-group">

				<!-- PLACE YOUR LOGO HERE -->
				<span id="logo"> <img src="/logo/avian-brands.png" alt="Logo"> </span>
				<!-- END LOGO PLACEHOLDER -->


			</div>

			<!-- #TOGGLE LAYOUT BUTTONS -->
			<!-- pulled right: nav area -->
			<div class="pull-right">

				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->

				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="/manager/logout" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
				</div>
				<!-- end logout button -->

				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->

                <!-- clear local storage button -->
                <div id="reset" class="btn-header transparent pull-right">
                    <span> <a title="Reset UI" data-action="resetWidgets"><i class="fa fa-history"></i></a> </span>
                </div>
                <!-- end clear local storage button -->

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->

        <!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is -->

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="/logo/favicon-32x32.png" alt="me" class="online" />
						<span>
							<?= $this->session->sess_login_admin['name']; ?>
						</span>
						<i class="fa fa-angle-down"></i>
					</a>

				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!--
				NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional href="" links. See documentation for details.
				-->

				<ul>
					<li class="<?= (isset($active_page) && $active_page == "dashboard") ? "active" : ""?>">
						<a href="/manager"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "admin") ? "active" : ""?>">
						<a href="/manager/admin"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Admin</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "slider") ? "active" : ""?>">
						<a href="/manager/slider"><i class="fa fa-lg fa-fw fa-image"></i> <span class="menu-item-parent">Slider</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "slider") ? "active" : ""?>">
						<a href="/manager/slidermobile"><i class="fa fa-lg fa-fw fa-image"></i> <span class="menu-item-parent">Slider Mobile</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "menu") ? "active" : ""?>">
						<a href="/manager/menu"><i class="fa fa-lg fa-fw fa-square-o"></i> <span class="menu-item-parent">Menu</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "page") ? "active" : ""?>">
						<a href="/manager/page"><i class="fa fa-lg fa-fw fa-file-text"></i> <span class="menu-item-parent">Page</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "store") ? "active" : ""?>">
						<a href="#"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Store</span> </a>
						<ul>
		                    <li class="<?= (isset($active_page) && $active_page == "store") ? "active" : ""?>">
		                        <a href="/manager/store"><i class="fa fa-lg fa-fw fa-building"></i> Store </a>
		                    </li>
                            <!--
		                    <li class="<?= (isset($active_page) && $active_page == "store-review") ? "active" : ""?>">
								<a href="/manager/store/review/list-review"><i class="fa fa-lg fa-fw fa-thumbs-up"></i> <span class="menu-item-parent">Store Review</span></a>
							</li>
							<li class="<?= (isset($active_page) && $active_page == "store-comment") ? "active" : ""?>">
								<a href="/manager/store/comment/list-comment"><i class="fa fa-lg fa-fw fa-comments"></i> <span class="menu-item-parent">Store Comment</span></a>
							</li>
                            -->
		                </ul>
					</li>

					<!-- Adding colour menu -->
					<li class="">
		                <a href="#"><i class="fa fa-lg fa-fw fa-paint-brush"></i> <span class="menu-item-parent">Colours</span> </a>
		                <ul>
		                    <li class="<?= (isset($active_page) && $active_page == "colours") ? "active" : ""?>">
		                        <a href="/manager/colours/lists"><i class="fa fa-lg fa-fw fa-tint"></i> Colours</a>
		                    </li>
		                    <li class="<?= (isset($active_page) && $active_page == "pallete") ? "active" : ""?>">
		                        <a href="/manager/palette" title="Pallete"><i class="fa fa-lg fa-fw fa-paint-brush"></i> Pallete </a>
		                    </li>
		                </ul>
		            </li>
		            <!-- END colour menus -->

					<li class="">
                        <a href="#"><i class="fa fa-lg fa-fw fa-heartbeat"></i> <span class="menu-item-parent">CSR</span> </a>
                        <ul>
                            <li class="<?= (isset($active_page) && $active_page == "csr-artikel") ? "active" : ""?>">
                                <a href="/manager/csr/csr-artikel/lists"><i class="fa fa-lg fa-fw fa-heartbeat"></i> CSR Artikel</span></a>
		                    </li>
		                    <li class="<?= (isset($active_page) && $active_page == "csr") ? "active" : ""?>">
                                <a href="/manager/csr"><i class="fa fa-lg fa-fw fa-heartbeat"></i> CSR</span></a>
		                    </li>
                        </ul>

					</li>

					<li class="">
		                <a href="#"><i class="fa fa-lg fa-fw fa-cubes"></i> <span class="menu-item-parent">Product</span> </a>
		                <ul>
		                    <li class="<?= (isset($active_page) && $active_page == "product-category") ? "active" : ""?>">
		                        <a href="/manager/product/category/list-category"><i class="fa fa-lg fa-fw fa-tags"></i> Product Category</a>
		                    </li>
		                    <li class="<?= (isset($active_page) && $active_page == "product") ? "active" : ""?>">
		                        <a href="/manager/product/products/list-product"><i class="fa fa-lg fa-fw fa-cubes"></i> Product </a>
		                    </li>
		                    <li class="<?= (isset($active_page) && $active_page == "product-slider") ? "active" : ""?>">
		                        <a href="/manager/product/slider/list-slider"><i class="fa fa-lg fa-fw fa-picture-o"></i> Product Slider </a>
		                    </li>
                            <!--
		                    <li class="<?= (isset($active_page) && $active_page == "product-review") ? "active" : ""?>">
								<a href="/manager/product/review/list-review"><i class="fa fa-lg fa-fw fa-thumbs-up"></i> <span class="menu-item-parent">Product Review</span></a>
							</li>
							<li class="<?= (isset($active_page) && $active_page == "product-comment") ? "active" : ""?>">
								<a href="/manager/product/comment/list-comment"><i class="fa fa-lg fa-fw fa-comments"></i> <span class="menu-item-parent">Product Comment</span></a>
							</li>
                            -->
		                </ul>
		            </li>

		            <li class="">
						<a href="#"><i class="fa fa-lg fa-fw fa-briefcase"></i> <span class="menu-item-parent">Career</span></a>
                        <ul>
                        	<li class="<?= ((isset($active_page) && $active_page == "applicants")) ? "active" : ""?>">
								<a href="/manager/career/applicants/lists" title="Applicants"><span class="menu-item-parent">Applicants</span></a>
							</li>
                            <li class="<?= ((isset($active_page) && $active_page == "job_offers")) ? "active" : ""?>">
								<a href="/manager/career/job/lists" title="Job Offers"><span class="menu-item-parent">Job Offers</span></a>
							</li>
                        </ul>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "member") ? "active" : ""?>">
						<a href="/manager/member"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Member</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "contact_us") ? "active" : ""?>">
						<a href="/manager/contact-us"><i class="fa fa-lg fa-fw fa-envelope"></i> <span class="menu-item-parent">Contact</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "faq") ? "active" : ""?>">
						<a href="/manager/faq"><i class="fa fa-lg fa-fw fa-question-circle"></i> <span class="menu-item-parent">FAQ</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "awards") ? "active" : ""?>">
						<a href="/manager/awards"><i class="fa fa-lg fa-fw fa-trophy"></i> <span class="menu-item-parent">Awards</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "offices") ? "active" : ""?>">
						<a href="/manager/pemasaran"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Pemasaran</span></a>
					</li>

                    <li class="<?= (isset($active_page) && $active_page == "article") ? "active" : ""?>">
						<a href="/manager/article"><i class="fa fa-lg fa-fw fa-file-o"></i> <span class="menu-item-parent">Article</span></a>
					</li>

					<li class="<?= (isset($active_page) && $active_page == "event") ? "active" : ""?>">
						<a href="/manager/event/lists"><i class="fa fa-lg fa-fw fa-star"></i> <span class="menu-item-parent">Event</span></a>
					</li>

					<li class="">
						<a href="#"><i class="fa fa-lg fa-fw fa-files-o"></i> <span class="menu-item-parent">Visualizer</span></a>
                        <ul>
                        	<li class="<?= ((isset($active_page) && $active_page == "vlocation")) ? "active" : ""?>">
								<a href="/manager/visualize/location/lists" title="Visualizer Location"><span class="menu-item-parent">Visualizer Location</span></a>
							</li>
                            <li class="<?= ((isset($active_page) && $active_page == "vresult")) ? "active" : ""?>">
								<a href="/manager/visualize/result/lists" title="Visualizer Result"><span class="menu-item-parent">Visualizer Result</span></a>
							</li>
                        </ul>
					</li>

                    <!--
					<li class="<?= (isset($active_page) && $active_page == "promo") ? "active" : ""?>">
						<a href="/manager/promo"><i class="fa fa-lg fa-fw fa-cc-mastercard"></i> <span class="menu-item-parent">Promo</span></a>
					</li>
                    -->

					<li class="<?= (isset($active_page) && $active_page == "country") ? "active" : ""?>">
						<a href="/manager/country"><i class="fa fa-lg fa-fw fa-map"></i> <span class="menu-item-parent">Country</span></a>
					</li>

					<!-- Adding province menu -->
					<li class="<?= (isset($active_page) && $active_page == "province") ? "active" : ""?>">
						<a href="/manager/province/lists"><i class="fa fa-lg fa-fw fa-flag"></i> <span class="menu-item-parent">Province</span></a>
					</li>
					<!-- END province menus -->

					<!-- Adding province menu -->
					<li class="<?= (isset($active_page) && $active_page == "chat") ? "active" : ""?>">
						<a href="/manager/chat/lists"><i class="fa fa-lg fa-fw fa-comments"></i> <span class="menu-item-parent">Chat</span></a>
					</li>
					<!-- END province menus -->

                    <!-- Polling -->
                    <li class="">
						<a href="#"><i class="fa fa-lg fa-fw fa-flask"></i> <span class="menu-item-parent">Polling</span></a>
                        <ul>
                        	<li class="<?= ((isset($active_page) && $active_page == "pol_list")) ? "active" : ""?>">
								<a href="/manager/Polling/lists" title="Polling List"><span class="menu-item-parent">Polling List</span></a>
							</li>
                            <li class="<?= ((isset($active_page) && $active_page == "pol_create")) ? "active" : ""?>">
								<a href="/manager/Polling/create" title="Create New Polling"><span class="menu-item-parent">Create New Polling</span></a>
							</li>
                        </ul>
					</li>
                    <!-- END Polling -->

                    <!--
					<!-- Adding merchant menu
					<li class="<?= (isset($active_page) && $active_page == "merchant") ? "active" : ""?>">
						<a href="/manager/merchant/lists"><i class="fa fa-lg fa-fw fa-shopping-bag"></i> <span class="menu-item-parent">Merchant</span></a>
					</li>
					<!-- END merchant menu

                    <li class="<?= (isset($active_page) && $active_page == "voucher") ? "active" : ""?>">
						<a href="/manager/vouchers/voucher/list-voucher"><i class="fa fa-lg fa-fw fa-credit-card"></i> <span class="menu-item-parent">Vouchers</span></a>
					</li>
					<li class="<?= (isset($active_page) && $active_page == "voucher") ? "active" : ""?>">
						<a href="/manager/point"><i class="fa fa-lg fa-fw fa-cc-paypal"></i> <span class="menu-item-parent">Point Configuration</span></a>
					</li>
                    -->
				</ul>
			</nav>

			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->

		<!-- #MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" onclick="location.reload();" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reload this page." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<?= isset($breadcrumb) ? $breadcrumb : "" ?>
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->
