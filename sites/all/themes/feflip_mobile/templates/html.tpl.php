        
        
        <!DOCTYPE html>
        <!--[if lt IE 7]>      <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
        <!--[if IE 7]>         <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
        <!--[if IE 8]>         <html ng-app="ffApp" class="no-js lt-ie9"> <![endif]-->
        <!--[if gt IE 8]><!--> <html ng-app="ffApp" class="no-js"> <!--<![endif]-->       
        
        <head>
			<?php // | i | Social Media block... ?>
            <?php echo $head; ?>
            <?php // | i | Languages and Canonical... ?>
            <meta content="initial-scale=1, minimum-scale=1, width=device-width, user-scalable=no" name="viewport">
            
            <title><?php echo $head_title; ?></title>
            <link rel="shortcut icon" href="/sites/all/themes/feflip_mobile/media/brand/favicon.ico" type="image/x-icon">
            <link rel="icon"          href="/sites/all/themes/feflip_mobile/media/brand/favicon.ico" type="image/x-icon">
                
            <link rel="image_src"    href="<?php echo drupal_get_path('theme', 'feflip_mobile').'/media/sharing/'.$siteImage.'.jpg'; ?>">
            
            <?php // | i | Set-up scripts and Less files...  ?>
            
            <link   href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
            <link   rel="stylesheet"  href="/<?php echo drupal_get_path('theme', 'feflip_mobile'); ?>/style/style-nology.css" title="style-nology" type="text/css" media="screen">
            <script src="/<?php echo drupal_get_path('theme', 'feflip_mobile'); ?>/library/vendors/modernizr.custom.f+f.js"></script>
        </head>
        
        <body class="<?php echo variable_get('pageID'); ?>" ng-controller="BodyCtrl" ng-init="user = <?php echo AdminForms::userIsLoggedIn();?>">
        
        <?php include 'header.html.php'; ?>

        <?php echo $page; ?>
    
        <?php include 'footer.html.php'; ?>
    
      	</body>
      </html>