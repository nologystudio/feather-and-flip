

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
		</head>
		
		<body ng-controller="AppController" ng-init="user = false;view = ''">
			
			<?php include 'header.html.php'; ?>
			<?php echo $page; ?>
			<?php include 'footer.html.php'; ?>
			<?php include 'script.html.php'; ?>
		
		</body>
	</html>
	
