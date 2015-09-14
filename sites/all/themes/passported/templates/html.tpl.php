

	<!DOCTYPE html>
	<!--[if lt IE 7]>      <html ng-app="ppApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html ng-app="ppApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>         <html ng-app="ppApp" class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html ng-app="ppApp" class="no-js"> <!--<![endif]-->
		<head>
			
			<?php echo $head; ?>
			
			<base href="/">
			<title><?php echo $head_title; ?></title>
			<meta name="robots" content="noindex,nofollow">
			<!-- Icons -->
		    <link rel="icon" type="image/png" href="<?php echo drupal_get_path('theme','passported'); ?>/media/favicons/passported-favicon-64x64.png" sizes="64x64">
		    <link rel="icon" type="image/png" href="<?php echo drupal_get_path('theme','passported'); ?>/media/favicons/passported-favicon-32x32.png" sizes="32x32">
		    <link rel="icon" type="image/png" href="<?php echo drupal_get_path('theme','passported'); ?>/media/favicons/passported-favicon-16x16.png" sizes="16x16">
			<!-- Included Google Fonts -->
			<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
			<!-- Less Files comes here -->
			<link rel="stylesheet" href="<?php echo drupal_get_path('theme','passported'); ?>/style/style-nology.css" title="style-nology" type="text/css" media="screen">
			<!-- Modernizer and IE specyfic files -->  
			<script src="<?php echo drupal_get_path('theme','passported'); ?>/library/vendors/modernizr.custom.pp.js"></script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVp6xJDq_xg96DdjO3S1wmByGNmYoK4XQ"></script>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '<?php echo Env::GOOGLE_ANALYTICS_CODE ?>', 'auto');
                ga('send', 'pageview');

            </script>

            <?php // Facebook pixel control
            $envcontrol = Env::GOOGLE_ANALYTICS_CODE; ?>
            <?php if (!empty($envcontrol) && user_is_logged_in() && isset($_COOKIE['is_signup']) && ($_COOKIE['is_signup'] == 'true')) { ?>
                <script>(function() {
                        var _fbq = window._fbq || (window._fbq = []);
                        if (!_fbq.loaded) {
                            var fbds = document.createElement('script');
                            fbds.async = true;
                            fbds.src = '//connect.facebook.net/en_US/fbds.js';
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(fbds, s);
                            _fbq.loaded = true;
                        }
                    })();
                    window._fbq = window._fbq || [];
                    window._fbq.push(['track', '6035954624252', {'value':'0.01','currency':'USD'}]);
                </script>
                <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6035954624252&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
            <?php setcookie('is_signup', 'false'); } ?>
		</head>

	    <?php   // Set ng-init for reset passw lightbox and views
            $reset_l = ((AdminForms::userIsLoggedIn() && isset($_GET['pass-reset-token']) && !empty($_GET['pass-reset-token'])) ? 'true' : 'false');
			$path_args = end(explode('/', request_path()));
			$jsview = (empty($path_args) ? 'home' : $path_args);
        ?>
		
		<body ng-controller="AppController" ng-init="user = <?php echo AdminForms::userIsLoggedIn();?>; resetPassword = <?php echo $reset_l;?>;view = '<?php echo $jsview;?>'">
			
			<?php include 'header.html.php'; ?>
			<?php echo $page; ?>
			<?php include 'footer.html.php'; ?>
			<?php include 'script.html.php'; ?>
		
		</body>
	</html>
	
