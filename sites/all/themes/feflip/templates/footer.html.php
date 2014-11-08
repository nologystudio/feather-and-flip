
		
		
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
					<li><a href=""><?php echo $destination['withcountry']?></a></li>
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
				<a id="brand" href=""><img src="<?php echo variable_get('relativePath'); ?>media/brand/feather-and-flip-black-logo.png" alt="Feather+flip"/></a>
				<nav id="social-media" class="black">
					<a href="" rel="twitter"></a>
					<a href="" rel="facebook"></a>
					<a href="" rel="instagram"></a>
					<a href="" rel="pinterest"></a>
					<a href="" rel="google-plus"></a>
				</nav>
				<a id="tzell-brand" href="http://www.tzell.com/tzell/index.htm" target="_blank">
					<small>Powered by</small>
					<img src="<?php echo variable_get('relativePath'); ?>media/brand/tzell-logo.png" alt="Powered by Tzell Travel Group"/>
				</a>

				<small>2014 FEATHER+FLIP LLC. ALL RIGHTS RESERVED</small>
			</div>
		</footer>
		
		<?php include 'script.html.php'; ?>
		
		<script>
				$(document).ready(function() {
					$('#signupNewsLetter').submit(function() {

						alert('Performing subscription...');

						var formData = {
							'formID' 		: 'newsletterForm',
							'user_email' 		: $('#user-email').val(),

						};

						$.ajax({
							type   : 'POST',
							url    : '/sites/all/themes/feflip/forms_controller/admin_forms_submit.php',
							data   : formData,
							success: function(msg) {
								alert(msg);
							}
						});
						return false;
					});
				});
		</script>			
		
		</body>
		
		</html>