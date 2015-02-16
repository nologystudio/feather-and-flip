
		
		
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
				
				<div id="ssl-label">
					<table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
						<tr>
							<td width="135" align="center" valign="top">
								<script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=www.featherandflip.com&amp;size=L&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script>
							</td>
						</tr>
					</table>
				</div>
								
				<a id="tzell-brand" href="http://www.tzell.com/tzell/index.htm" target="_blank">
					<small>Powered by</small>
					<img src="<?php echo variable_get('relativePath'); ?>media/brand/tzell-logo.png" alt="Powered by Tzell Travel Group"/>
				</a>

				<small><?php echo date("Y"); ?> FEATHER+FLIP LLC. ALL RIGHTS RESERVED</small>
			</div>
		</footer>
		
		<div class="call-to-action" ng-controller="MessengerCtrl" ng-include="messenger" ng-show="display"></div>
		<?php include 'script.html.php'; ?>
		</body>
		
		</html>