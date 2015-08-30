

        <!DOCTYPE html>
        <!--[if lt IE 7]>      <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
        <!--[if IE 7]>         <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
        <!--[if IE 8]>         <html ng-app="ffApp" class="no-js lt-ie9"> <![endif]-->
        <!--[if gt IE 8]><!--> <html ng-app="ffApp" class="no-js"> <!--<![endif]-->

        <head>
			<?php echo $head; ?>
            <meta content="initial-scale=0.9, minimum-scale=0.9, width=device-width, user-scalable=no" name="viewport">

            <title><?php echo $head_title; ?></title>
            <link rel="shortcut icon" href="/sites/all/themes/feflip/media/brand/favicon.ico" type="image/x-icon">
            <link rel="icon"          href="/sites/all/themes/feflip/media/brand/favicon.ico" type="image/x-icon">

            <link   rel="image_src"    href="<?php echo drupal_get_path('theme', 'feflip').'/media/brand/passported-black-logo.png'; ?>">
            <link   href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
            <link   rel="stylesheet"  href="<?php echo variable_get('relativePath'); ?>style/style-nology.css" title="style-nology" type="text/css" media="screen">
            <script src="<?php echo variable_get('relativePath'); ?>library/vendors/modernizr.custom.f+f.js"></script>

            <script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', '<?php echo Env::GOOGLE_ANALYTICS_CODE ?>', 'auto');
			  ga('send', 'pageview');

			</script>

            <?php // Facebook pixel control ?>
            <?php if ((strpos('stage', $_SERVER['SERVER_NAME']) === false) && user_is_logged_in() && isset($_COOKIE['is_signup']) && ($_COOKIE['is_signup'] == 'true')) { ?>
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
            <?php unset($_COOKIE['is_signup']); } ?>
        </head>

        <?php   // Set ng-init for reset passw lightbox
            $reset_l = ((AdminForms::userIsLoggedIn() && isset($_GET['pass-reset-token']) && !empty($_GET['pass-reset-token'])) ? 'true' : 'false');
        ?>

        <body class="<?php echo variable_get('pageID'); ?>" ng-controller="BodyCtrl" ng-init="user = <?php echo AdminForms::userIsLoggedIn();?>; resetPassword = <?php echo $reset_l; ?>">

        <?php include 'header.html.php'; ?>

        <?php echo $page; ?>

        <?php include 'footer.html.php'; ?>

      </body>
  </html>
        
  	