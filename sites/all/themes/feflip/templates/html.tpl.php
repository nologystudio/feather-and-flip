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
        // | i | Navigation...
        $state          = $pageID;
        // | i | http://ogp.me | Opengraph protocol...
        $opengraph      = true;
        $twitterCard    = false;
        // | i | Path & Media assets...
        $productionURL  = 'feather+flip.com';
        $uriSplitter    = explode('/',$_SERVER['REQUEST_URI']);
        $url            = ($_SERVER['HTTP_HOST'] == $productionURL) ? '' : $uriSplitter[1].'/sites/all/themes/feflip'; 
        $relativePath   = $url.'/';
        $logoPath       = "media/x-logo.png";
        
        $pageURL         = "";
        $pageDescription = "";
        $pageKeywords    = "";
        $siteImage       = "";
        
        ?>
        
        <!DOCTYPE html>
        <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
        <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
        <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
        <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
        
        <head>
            <meta charset="utf-8">
            <meta name="language" content="es"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <!--<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9">-->
            <meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">		    
            <base href="/feather-and-flip/">
            
            <title><?php echo $headerTitle; ?></title>
            <link rel="shortcut icon" href="media/favicon.ico" type="image/x-icon">
                <link rel="icon"          href="media/favicon.ico" type="image/x-icon">
                
            <link rel="image_src"    href="<?php echo $relativePath.'media/sharing/'.$siteImage.'.jpg'; ?>">
            <meta name="description" content="<?php echo $pageDescription; ?>">
            <meta name="keywords"    content="<?php echo $pageKeywords; ?>">
           
            <?php // | i | Social Media block... ?>
            
            <?php if($opengraph): ?>
            
                    <meta property="og:title"       content="<?php echo $headerTitle; ?>"> 
                    <meta property="og:locale"      content="es">  
                    <meta property="og:image"       content="<?php echo $relativePath.'media/sharing/'.$siteImage.'.jpg'; ?>">
                    <meta property="og:description" content="<?php echo $pageDescription; ?>"> 
                    <meta property="og:url"         content="<?php echo $pageURL; ?>">
                    <meta property="og:type"        content="website">
                    
                    <meta property="og:article:published_time"  content=""> 
                    <meta property="og:article:modified_time"   content=""> 
                    <meta property="og:article:expiration_time" content=""> 
                    <meta property="og:article:author"          content=""> 
                    <meta property="og:article:section"         content=""> 
                    <meta property="og:article:tag"  			content=""> 
                    
            <?php endif; ?>
            
            <?php if($twitterCard): ?>
            
                    <meta name="twitter:card"        content="summary">
                    <meta name="twitter:site"        content="@nologystudio">
                    <meta name="twitter:creator"     content="">
                    <meta name="twitter:url"         content="">
                    <meta name="twitter:title"       content="">
                    <meta name="twitter:description" content="<?php echo $pageDescription; ?>">
                    <meta name="twitter:image"       content="">
            
            <?php endif; ?>
            
                <?php // | i | Languages and Canonical... ?>
               
            <link rel="canonical" href="">		    
            <link rel="alternate" hreflang="x-default" href="">
            <link rel="alternate" hreflang="en-UK" href="" title="English (UK)">
            
            <?php // | i | Set-up scripts and Less files...  ?>
            
            <link   rel="stylesheet/less"  href="<?php echo $relativePath; ?>style/style-nology.less?v=1.0" title="style-nology" type="text/css" media="screen">
                <script type="text/javascript" src="<?php echo $relativePath; ?>library/vendors/less-1.7.4.min.js"></script>		
                <script src="<?php echo $relativePath; ?>library/vendors/modernizr.custom.f+f.js"></script>
                
                
        </head>
        
        <body class="<?php echo $pageID; ?>" <?php if(isset($jsTrigger)) echo 'data-trigger="'.$jsTrigger.'"'; ?> data-section="<?php echo $pageID; ?>">

        <?php include 'header.html.php'; ?>
    
        <?php echo $page; ?>
    
        <?php include 'footer.html.php'; ?>
    
      </body>
  </html>
        
  	