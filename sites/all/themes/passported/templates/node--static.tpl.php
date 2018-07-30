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
					<p>
						Henley’s decade of experience in the travel industry includes Town & Country Travel, National Geographic Traveler, Departures, Ultratravel and Indagare. Before settling down in New York with her husband and three children, Henley lived in Madrid and Tokyo. Her favorite destinations include Cartagena, St. Barth’s, and anywhere in Spain. Henley is originally from Virginia and graduated from Princeton University.
					</p>
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
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/monique-thofte.jpg" alt="MONIQUE THOFTE, DIRECTOR OF TRAVEL"/>
					</figure>
					<h3>MONIQUE THOFTE, DIRECTOR OF TRAVEL</h3>
					<p>
						Monique Thofte joined the Passported team after honing her travel planning skills at Indagare Travel. Her expertise ranges from Tuscan vineyard resorts to hip beach hideaways and perfect urban retreats. Monique’s favorite destinations include Angra Dos Reis, Stockholm and St. Barth’s. A Jersey girl by birth, Monique now lives in Brooklyn with her husband and daughter and studied communications at University of Miami.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/brandi-wilson.jpg" alt="BRANDI WILSON, TRAVEL ADVISOR"/>
					</figure>
					<h3>BRANDI WILSON, TRAVEL ADVISOR</h3>
					<p>
						Brandi joined Passported following a decade running the creative advertising headhunting firm she founded to service over 40 of the globe’s top ad agencies. Favorite destinations include Morocco, India, Japan, Tulum, Peru, Vietnam and the Andaman Sea. Recent scouts include Cape Town, St. Barths, Sedona, Seattle (her hometown!) and Nepal with National Geographic Journeys.  She graduated from Bennington College and currently lives in Brooklyn but dreams of renovating a riad in Marrakech and a crumbling mansion in the Garden District of New Orleans.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/patricia-cancio.jpg" alt="BRANDI WILSON, DIRECTOR OF TRAVEL"/>
					</figure>
					<h3>PATRICIA CANCIO, TRAVEL ADVISOR</h3>
					<p>
						Patricia speaks six languages and has lived in seven cities across three continents. Her favorite destination is always going to be anywhere she's never been. Patricia graduated from Saint Louis University with a bachelor's degree in Communications.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/elisa-brown.jpg" alt="ELISA BROWN, INDEPENDENT TRAVEL CONSULTOR"/>
					</figure>
					<h3>ELISA BROWN, INDEPENDENT TRAVEL CONSULTOR</h3>
					<p>
						Elisa Brown aka Passported client, turned Contributor turned Advisor specializes in couples and family with teens travel. Elisa’s favorite destinations include anything Italy, Greece, Morocco and the outer islands of the Bahamas. Born and raised on the Gold Coast of CT, Elisa spent her college years in our nation's capital and ten summers on Martha's Vineyard. Elisa currently resides in Fairfield County, CT with her three children Jack, Finlay and Hadley.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/dana-farrington.jpg" alt="DANA FARRINGTON, INDEPENDENT TRAVEL CONSULTOR"/>
					</figure>
					<h3>DANA FARRINGTON, INDEPENDENT TRAVEL CONSULTOR</h3>
					<p>
						Dana joined the Passported team after years of planning trips for her own friends and family. Ever since an around-the-world voyage in college called “Semester at Sea,” she has been on the move. She has visited 56 countries, but there are many more on her list to discover, with her husband and twin boys in tow. Dana was born and raised in the Bahamas and loves to return home — especially in the winter. She lived in Bermuda and South Africa before settling in New York City. Dana’s favorite destinations include Harbour Island, Botswana, and Paris.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/leslie-overton.jpg" alt="LESLIE OVERTON, INDEPENDENT TRAVEL CONSULTOR"/>
					</figure>
					<h3>LESLIE OVERTON, INDEPENDENT TRAVEL CONSULTOR, HEAD OF BOARD AND MAJOR DONOR TRAVEL PROGRAMMING</h3>
					<p>
						Leslie worked with Absolute Travel for 23 years, facilitating the company’s growth from a 3-person start-up focused on Southeast Asia to a 30 person, Travel & Leisure World’s Best Tour Operator specializing in luxury travel across seven continents. Leslie also founded Absolute Travel’s philanthropic-focused Awareness division, which has taken her to meetings with Nobel Peace Prize winners in Liberia and led to collaborations with grassroots human rights defenders in Guatemala. She continues to work with philanthropies such as Human Rights Watch, World Wildlife Foundation, and American Jewish World Service on donor engagement trips. Leslie has visited over 65 countries, many with her husband and 3 kids. She is Conde Nast Traveler’s Top Travel Specialist for Family Travel to Exotic Destinations and has a bachelor’s degree in Art History from NYU.
					</p>
				</li>
			</ul>
		</article>

		<?php endif; ?>
	</section>

<?php }?>
