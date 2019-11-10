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
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/monique-thofte.jpg" alt="MONIQUE THOFTE, DIRECTOR OF TRAVEL"/>
					</figure>
					<h3>MONIQUE THOFTE, DIRECTOR OF TRAVEL</h3>
					<p>
						Monique Thofte joined the Passported team after honing her travel planning skills at Indagare Travel. Her expertise ranges from Tuscan vineyard resorts to hip beach hideaways and perfect urban retreats. Monique’s favorite destinations include Angra Dos Reis, Stockholm and St. Barth’s. A Jersey girl by birth, Monique now lives in Brooklyn with her husband and daughter and studied communications at University of Miami.
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
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/elisa-brown.jpg" alt="ELISA BROWN, INDEPENDENT TRAVEL CONSULTANT"/>
					</figure>
					<h3>ELISA BROWN, INDEPENDENT TRAVEL CONSULTANT</h3>
					<p>
						Elisa Brown aka Passported client, turned Contributor turned Advisor specializes in couples and family with teens travel. Elisa’s favorite destinations include anything Italy, Greece, Morocco and the outer islands of the Bahamas. Born and raised on the Gold Coast of CT, Elisa spent her college years in our nation's capital and ten summers on Martha's Vineyard. Elisa currently resides in Fairfield County, CT with her three children Jack, Finlay and Hadley.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/dana-farrington.jpg" alt="DANA FARRINGTON, INDEPENDENT TRAVEL CONSULTANT"/>
					</figure>
					<h3>DANA FARRINGTON, INDEPENDENT TRAVEL CONSULTANT</h3>
					<p>
						Dana joined the Passported team after years of planning trips for her own friends and family. Ever since an around-the-world voyage in college called “Semester at Sea,” she has been on the move. She has visited 56 countries, but there are many more on her list to discover, with her husband and twin boys in tow. Dana was born and raised in the Bahamas and loves to return home — especially in the winter. She lived in Bermuda and South Africa before settling in New York City. Dana’s favorite destinations include Harbour Island, Botswana, and Paris.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/leslie-overton.jpg" alt="LESLIE OVERTON, INDEPENDENT TRAVEL CONSULTANT"/>
					</figure>
					<h3>LESLIE OVERTON, INDEPENDENT TRAVEL CONSULTANT, HEAD OF BOARD AND MAJOR DONOR TRAVEL PROGRAMMING</h3>
					<p>
						Leslie worked with Absolute Travel for 23 years, facilitating the company’s growth from a 3-person start-up focused on Southeast Asia to a 30 person, Travel & Leisure World’s Best Tour Operator specializing in luxury travel across seven continents. Leslie also founded Absolute Travel’s philanthropic-focused Awareness division, which has taken her to meetings with Nobel Peace Prize winners in Liberia and led to collaborations with grassroots human rights defenders in Guatemala. She continues to work with philanthropies such as Human Rights Watch, World Wildlife Foundation, and American Jewish World Service on donor engagement trips. Leslie has visited over 65 countries, many with her husband and 3 kids. She is Conde Nast Traveler’s Top Travel Specialist for Family Travel to Exotic Destinations and has a bachelor’s degree in Art History from NYU.
					</p>
				</li>
				<li>
					<figure>
						<img src="<?php echo drupal_get_path('theme','passported'); ?>/media/about/chelsea-farthing.jpg" alt="CHELSEA FARTHING"/>
					</figure>
					<h3>CHELSEA FARTHING, TRAVEL ADVISOR</h3>
					<p>
						Chelsea’s love of travel and planning brought her to Passported after many years as a professional actor. She loves a good adventure and some of her favorite destinations include Tanzania, Peru, Sri Lanka, London and Hawaii. She graduated with a BFA in Actor Training from The Hartt School, University of Hartford. Chelsea currently lives with her husband in Manhattan. 
					</p>
				</li>
			</ul>
		</article>

		<?php endif; ?>
	</section>

<?php }?>
