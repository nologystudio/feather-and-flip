        
        
        <!DOCTYPE html>
        <!--[if lt IE 7]>      <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
        <!--[if IE 7]>         <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
        <!--[if IE 8]>         <html ng-app="ffApp" class="no-js lt-ie9"> <![endif]-->
        <!--[if gt IE 8]><!--> <html ng-app="ffApp" class="no-js"> <!--<![endif]-->       
        
        <head>
			<?php echo $head; ?>
            <meta content="initial-scale=1, minimum-scale=1, width=device-width, user-scalable=no" name="viewport">
            
            <title><?php echo $head_title; ?></title>
            <link rel="shortcut icon" href="/sites/all/themes/feflip_mobile/media/brand/favicon.ico" type="image/x-icon">
            <link rel="icon"          href="/sites/all/themes/feflip_mobile/media/brand/favicon.ico" type="image/x-icon">
                
            <link   rel="image_src"    href="<?php echo drupal_get_path('theme', 'feflip_mobile').'/media/brand/feather-and-flip-black-logo.png'; ?>">
            <link   href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
            <link   rel="stylesheet"  href="/<?php echo drupal_get_path('theme', 'feflip_mobile'); ?>/style/style-nology.css" title="style-nology" type="text/css" media="screen">
            <script src="/<?php echo drupal_get_path('theme', 'feflip_mobile'); ?>/library/vendors/modernizr.custom.f+f.js"></script>
        
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

              ga('create', '<?php echo Env::GOOGLE_ANALYTICS_CODE ?>', 'auto');
			  ga('send', 'pageview');
			
			</script> 
        </head>
        
        <body class="<?php echo variable_get('pageID'); ?>" ng-controller="BodyCtrl" ng-init="user = <?php echo AdminForms::userIsLoggedIn();?>">
        
        <?php include 'header.html.php'; ?>

        <?php echo $page; ?>
    
        <?php include 'footer.html.php'; ?>
    
      	</body>
      </html>