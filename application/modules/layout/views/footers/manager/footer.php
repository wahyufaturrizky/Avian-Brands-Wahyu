            <div class="loading-box"><div class="cssload-box-loading"></div></div>
        </div>
		<!-- END #MAIN PANEL -->

		<!-- #SHORTCUT AREA : With large tiles (activated via clicking user name tag)
			 Note: These tiles are completely responsive, you can add as many as you like -->
		<div id="shortcut">
			<ul>
				<li>
					<a href="/manager/admin/change-profile" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-id-card-o fa-4x"></i> <span>Change Profile </span> </span> </a>
				</li>
                <li>
					<a href="/manager/admin/change-password" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-key fa-4x"></i> <span>Change Password </span> </span> </a>
				</li>
			</ul>
		</div>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->

        <link rel="stylesheet" type="text/css" media="screen" href="/js/plugins/cropper/cropper.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/js/plugins/cropper/crop.css">


		<!-- #PLUGINS -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local-->
		<script src="/js/jquery-1.12.4.min.js"></script>
		<script src="/js/jquery-ui-1.12.1.min.js"></script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="/js/app.config.seed.js"></script>
		<script src="/js/plugins/smartwidgets/jarvis.widget.min.js"></script>
		<script src="/js/plugins/jquery-touch/jquery.ui.touch-punch.min.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/plugins/sweetalert.min.js"></script>
        <script src="/js/plugins/SmartNotification.min.js"></script>

        <!-- form and validate js -->
        <script src="/js/plugins/jquery.form.min.js"></script>
        <script src="/js/plugins/jquery.validate.min.js"></script>

        <!-- cropper -->
        <script src="/js/plugins/cropper/cropper.min.js"></script>

        <!-- daterange picker -->
        <script src="/js/plugins/moment.js"></script>
        <script src="/js/plugins/bootstrap-daterangepicker-master/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="/js/plugins/bootstrap-daterangepicker-master/daterangepicker.css">

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="/js/app.js?ver=<?= VERSION ?>"></script>
		<script src="/js/global.js?ver=<?= VERSION ?>"></script>
		<script src="/js/crop-master.js?ver=<?= VERSION ?>"></script>
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
    </body>
</html>
