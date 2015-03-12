        <?php 
        
        /* ----------------------------------------------------------------------------------------------------------------
            
    * Project     : F+F
    * Document    : header 
    * Created on  : Oct 08, 2.014
    * Version     : 1.0 
    * Author      : Aday Henriquez
    * Description : Global header html template
    * Components  : Less
    
    -------------------------------------------------------------------------------------------------------------------
       *          This code has been developed by Nology. in the awesome Canaries - www.nologystudio.com           *
    -------------------------------------------------------------------------------------------------------------------
   
    * Log * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
-------------------------------------------------------------------------------------------------------------------
*  
---------------------------------------------------------------------------------------------------------------- */ ?>

        <?php 
        
        /* ------------------------------------------------------------------------------------------------------------- */
        /* | i | Development configuration */
        /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
        
        $stageServer      = "54.164.51.183"; 
        $productionServer = "feather+flip.com";
        
        $brandName       = variable_get('site_name');
        $siteName        = variable_get('site_slogan');
        $pageTitle       = $head_title_array['title'];
         
        $useLess = true;
        $inDev   = true;
        
        /* ------------------------------------------------------------------------------------------------------------- */
        /* | i | Global header configuration */
        /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
        
        // | i | jsTrigger: this get variable triggers functionalities in javascript...
        $jsTrigger      = (isset($_GET['js']) ? $_GET['js'] : '');
        // | i | Header...
        $headerTitle    = $brandName.' | '.$pageTitle;

        // | i | http://ogp.me | Opengraph protocol...
        $opengraph      = true;
        $twitterCard    = false;
        // | i | Path & Media assets...

        $logoPath       = "media/x-logo.png";
        
        $pageURL         = "";
        $pageDescription = "";
        $pageKeywords    = "";
        $siteImage       = "";
        
        ?>
        
        <!DOCTYPE html>
        <!--[if lt IE 7]>      <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
        <!--[if IE 7]>         <html ng-app="ffApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
        <!--[if IE 8]>         <html ng-app="ffApp" class="no-js lt-ie9"> <![endif]-->
        <!--[if gt IE 8]><!--> <html ng-app="ffApp" class="no-js"> <!--<![endif]-->       
        
        <head>

            <!--<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9">-->
            <?php // | i | Social Media block... ?>
            <?php echo $head; ?>
            <?php // | i | Languages and Canonical... ?>
            <!--<meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">-->	    
            
            <title><?php echo $headerTitle; ?></title>
            <link rel="shortcut icon" href="/sites/all/themes/feflip/media/brand/favicon.ico" type="image/x-icon">
            <link rel="icon"          href="/sites/all/themes/feflip/media/brand/favicon.ico" type="image/x-icon">
                
            <link rel="image_src"    href="<?php echo variable_get('relativePath').'media/sharing/'.$siteImage.'.jpg'; ?>">
               
            <link rel="canonical" href="">		    
            <link rel="alternate" hreflang="x-default" href="">
            <link rel="alternate" hreflang="en-US" href="" title="English (US)">
            
            <?php // | i | Set-up scripts and Less files...  ?>
            
            <link   href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
            <link   rel="stylesheet"  href="<?php echo variable_get('relativePath'); ?>style/style-nology.css" title="style-nology" type="text/css" media="screen">
            <script src="<?php echo variable_get('relativePath'); ?>library/vendors/modernizr.custom.f+f.js"></script>
                
                
        </head>
        
        <body class="<?php echo variable_get('pageID'); ?>" ng-controller="BodyCtrl" ng-init="user = <?php echo AdminForms::userIsLoggedIn();?>">
        
        <?php include 'header.html.php'; ?>

        <?php echo $page; ?>
    
        <?php include 'footer.html.php'; ?>
    
      </body>
  </html>
        
  	