
		
		
		<?php 
		
		/* ----------------------------------------------------------------------------------------------------------------
		    
	    * Project     : F+F
	    * Document    : footer 
	    * Created on  : Oct 08, 2.014
	    * Version     : 1.0 
	    * Author      : Aday Henriquez
	    * Description : Global footer html template
	    * Components  : Google Analytics
	    
	    -------------------------------------------------------------------------------------------------------------------
	       *          This code has been developed by Nology. in the awesome Canaries - www.nologystudio.com           *
	    -------------------------------------------------------------------------------------------------------------------
	   
	    * Log * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        -------------------------------------------------------------------------------------------------------------------
        *  
        ---------------------------------------------------------------------------------------------------------------- */ ?>		
		
		<footer>
			<nav>
				<ul>
					<li><span class="icon destination"></span>destinations</li>
					<?php foreach ($footer_destinations_menu as $destination) { ?>
					<li><a href="<?php echo $destination['url'].'/hotel-reviews'; ?>"><?php echo $destination['withcountry']?></a></li>
					<?php } ?>
				</ul>
				<ul>
					<li><span class="icon popular"></span>popular hotels</li>
					<?php foreach ($footer_hotels_menu as $hotel) {?>
					<li><a href="<?php echo $hotel['url']; ?>"><?php echo $hotel['name'].', '. $hotel['country'];?></a></li>
					<?php } ?>
				</ul>
				<?php echo $footer_fixed_menu; ?>
			</nav>
			<div class="fixed-bar">
				<a id="brand" href="/"><img src="<?php echo variable_get('relativePath'); ?>media/brand/feather-and-flip-black-logo.png" alt="Feather+flip"/></a>
				<?php echo Helpers::GetSocialMediaMenu('black');?>

				<a id="tzell-brand" href="http://www.tzell.com/tzell/index.htm" target="_blank">
					<small>Powered by</small>
					<img src="<?php echo variable_get('relativePath'); ?>media/brand/tzell-logo.png" alt="Powered by Tzell Travel Group"/>
				</a>

				<small><?php echo date("Y"); ?> FEATHER+FLIP LLC. ALL RIGHTS RESERVED</small>
			</div>
		</footer>
		
		<!-- | i | Overlay engine ------------------------------------------------------------ -->
		
		<?php //if (!user_is_logged_in()){?>
        <div class="call-to-action" ng-controller="MessengerCtrl" ng-include="messenger" ng-show="display"></div>
		<?php //} ?>
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
		
		
		<?php include 'script.html.php'; ?>
		
		<?php // Add autocomplete js files ?>
	<!--	<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/misc/drupal.js"></script>
		<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/misc/jquery.once.js?v=1.2"></script>
	-->	
		</body>
		
		</html>