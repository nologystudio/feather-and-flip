<?php if (strpos(strtoupper($title), 'CONTACT') !== false) {?>

	<section id="contact" class="static" ng-controller="ContactController">
		<header>
            <h1>GET IN TOUCH</h1>
            <h2>We'd love to hear from you. If you have a question, suggestion, or just want to talk travel, send us a note below.</h2>
		</header>
		<h4 ng-if="success" class="animated fadeInDown">Thank you for contacting us.</h4>
		<form id="contact-form" name="contactForm">
			<label for="user-name">
				Name*
				<input type="text" name="user-name" ng-model="data.userName" required/>
			</label>
			<label for="user-email">
				Email*
				<input type="email" name="user-email" ng-model="data.userEmail" required/>
			</label>
			<label for="user-message">
				Message*
				<textarea name="user-message" ng-model="data.userMessage" required></textarea>
			</label>
			<input type="submit" ng-class="{disabled:!contactForm.$valid}" ng-click="!contactForm.$valid || submitContact()"/>
		</form>
	</section>

<?php } else { ?>

	<section id="about" class="static">
		
		<article id="about">
			<h1><?php echo $title; ?></h1>
			<?php echo (isset($body[0]) ? $body[0]['safe_value'] : ''); ?>
		</article>
		
		<?php if (strpos(strtoupper($title), 'ABOUT') !== false): ?>
		
		<article id="who-we-are">
			<h2>Who we are</h2>
			<ul>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/henley-vazquez.jpg" alt="HENLEY VAZQUEZ, CEO/CO-FOUNDER"/>
					</figure>
					<h3>HENLEY VAZQUEZ, CEO/CO-FOUNDER</h3>
					<p>Henley’s decade of experience in the travel industry includes Town & Country Travel, National Geographic Traveler, Departures, Ultratravel and Indagare. Before settling down in New York with her husband and two children, Henley lived in Madrid and Tokyo. Her favorite destinations include Ibiza and Cartagena. Henley is originally from Virginia and graduated from Princeton University.</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/nicole-rubin.jpg" alt="NICOLE RUBIN, HEAD OF PRODUCT/CO-FOUNDER"/>
					</figure>
					<h3>NICOLE RUBIN, HEAD OF PRODUCT/CO-FOUNDER</h3>
					<p>A New York native, Nicole has spent time in Paris and Copenhagen but calls Brooklyn home with her husband. Before joining the Passported team, she founded the itinerary planning platform Bon Voyaging and previously worked at Pace Gallery. Her favorite destinations include Jaipur, India and Jose Ignacio, Uruguay. Nicole graduated from Washington University and has an MBA from NYU’s Stern School of Business.</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/jd-boujnah.jpg" alt="JD BOUJNAH, CREATIVE DIRECTOR/CO-FOUNDER"/>
					</figure>
					<h3>JD BOUJNAH, CREATIVE DIRECTOR/CO-FOUNDER</h3>
					<p>JD’s award-winning designs have been featured in The New York Times, Child Magazine, Women’s Wear Daily and numerous design publications, including Tres Logos and Coast to Coast. Prior to founding Calliope Studios, JD was a driving force behind the creation of Pitch TV and the Creative Director for Soundwalk. He also collaborated with powerhouses such as Puma and The Louvre Museum. JD holds a degree in Graphic Design from Rhode Island School of Design and a Masters from Parsons and lives in Greenwich, CT with his wife and three children.</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/monique-thofte.jpg" alt="MONIQUE THOFTE, DIRECOTR OF TRAVEL"/>
					</figure>
					<h3>MONIQUE THOFTE, DIRECTOR OF TRAVEL</h3>
					<p>Monique Thofte joined the Passported team after honing her travel planning skills at Indagare Travel. Her expertise ranges from Tuscan vineyard resorts to hip beach hideaways and perfect urban retreats. Monique’s favorite destinations include Angra Dos Reis, Stockholm and St. Barth’s. A Jersey girl by birth, Monique now lives in Brooklyn with her husband and daughter and studied communications at University of Miami.</p>
				</li>
			</ul>
		</article>
		
		<?php endif; ?>
	</section>
	
<?php }?>