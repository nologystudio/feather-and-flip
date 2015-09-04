	<?php include 'slideshowandmainmenu.html.php';?>


<?php if (strpos(strtoupper($title), 'BOOKING ERROR') !== false){ ?>

<section id="booking-engine">
    <div id="step-5">
        <header>
            <div class="wrapper">
                <div class="feather"></div>
                <h1>Error</h1>
                <h3><?php echo (isset($body[0]) ? $body[0]['safe_value'] : ''); ?></h3>
            </div>
        </header>
    </div>
</section>
<?php } else if(strpos(strtoupper($title), 'PAGE NOT FOUND') !== false){ ?>
        <section id="booking-engine">
            <div id="step-5">
                <header>
                    <div class="wrapper">
                        <div class="feather"></div>
                        <h1>Page not found</h1>
                        <h3><?php echo (isset($body[0]) ? $body[0]['safe_value'] : ''); ?></h3>
                    </div>
                </header>
            </div>
        </section>
<?php } else if(strpos(strtoupper($title), 'ACCESS DENIED') !== false){ ?>
    <section id="booking-engine">
        <div id="step-5">
            <header>
                <div class="wrapper">
                    <div class="feather"></div>
                    <h1>Access denied</h1>
                    <h3><?php echo (isset($body[0]) ? $body[0]['safe_value'] : ''); ?></h3>
                </div>
            </header>
        </div>
    </section>
<?php } else if (strpos(strtoupper($title), 'CONTACT') !== false) {?>
<section id="contact" class="static" ng-controller="ContactCtrl">
	<header>
		<h1>Use your words</h1>
		<h2>for questions about passported or to reach our editorial or sales team, please fill out our contact form.</h2>
	</header>
	<h4 ng-if="success" class="animated fadeInDown">Thank you for contacting us.</h4>
	<form id="contact-form" name="contactForm">
		<label for="user-name" class="half">
			Name*
			<input type="text" name="user-name" ng-model="data.userName" required/>
			<small>First name</small>
		</label>
		<label for="user-last" class="half no-label">
			<input type="text" name="user-last" ng-model="data.userLast" required/>
			<small>Last name</small>
		</label>
		<label for="user-email">
			Email*
			<input type="email" name="user-email" ng-model="data.userEmail" required/>
		</label>
		<label for="user-department">
			Select the appropriate department*
			<select ng-model="data.userDepartment">
				<option value="editorial" selected="selected">Editorial</option>
				<option value="Advertising">Advertising</option>
				<option value="Partnership Opportunities">Partnership Opportunities</option>
				<option value="General Inquiries">General Inquiries</option>
			</select>
		</label>
		<label for="user-subject">
			Subject*
			<input type="text" name="user-subject" ng-model="data.userSubject" required/>
		</label>
		<label for="user-message">
			Message*
			<textarea name="user-message" ng-model="data.userMessage" required></textarea>
		</label>
		<input type="submit" ng-class="{disabled:!contactForm.$valid}" ng-click="!contactForm.$valid || submitContact()"/>
	</form>
</section>
<?php } else { ?>
<section class="static">
	<article id="about">
		<h1><?php echo $title; ?></h1>
		<?php echo (isset($body[0]) ? $body[0]['safe_value'] : ''); ?>
	</article>
	<?php if (strpos(strtoupper($title), 'ABOUT') !== false): // Only for 'about us' page ?>
		<article id="who-we-are">
			<h2>Who we are</h2>
			<ul>
				<li>
					<figure>
						<img src="/sites/all/themes/feflip_mobile/media/about/henley-vazquez.jpg" alt="HENLEY VAZQUEZ, CEO/CO-FOUNDER"/>
					</figure>
					<h3>HENLEY VAZQUEZ, CEO/CO-FOUNDER</h3>
					<p>Henley’s decade of experience in the travel industry includes Town & Country Travel, National Geographic Traveler, Departures, Ultratravel and Indagare. Despite  her background, she found planning trips for her own family frustrating, and every parent she knew shared the same problems. Henley joined forces with the Passported team to create a website where families could easily decide where to stay, which room to reserve and what to do while they are there - all quickly bookable online. Her motto: life is too short for bad hotels. Henley lives in New York City with her husband and two children and graduated from Princeton University.</p>
				</li>
                <li>
                	<figure>
						<img src="/sites/all/themes/feflip_mobile/media/about/nikki-ridgway.jpg" alt="NIKKI RIDGWAY, EDITOR/CO-FOUNDER"/>
					</figure>
                    <h3>NIKKI RIDGWAY, EDITOR/CO-FOUNDER</h3>
                    <p>An English girl in New York, Nikki moved to New York  in 2009 after stints at travel magazines in Kuala Lumpur and London. She was associate editor at Indagare and, most recently, senior editor at Jetsetter.com. She has traveled to over 40 countries, including a yearlong trip around South America and a four-month passage across the Pacific Ocean. She lives in Brooklyn with her husband and son. Nikki studied English Literature at University of Sussex.</p>
                </li>
				<li>
					<figure>
						<img src="sites/all/themes/feflip_mobile/media/about/jd-boujnah.jpg" alt="JD BOUJNAH, CREATIVE DIRECTOR/CO-FOUNDER"/>
					</figure>
					<h3>JD BOUJNAH, CREATIVE DIRECTOR/CO-FOUNDER</h3>
					<p>JD’s award-winning designs have been featured in The New York Times, Child Magazine, Women’s Wear Daily and numerous design publications, including Tres Logos and Coast to Coast. Prior to founding Calliope Studios, JD was a driving force behind the creation of Pitch TV- rated one of the most innovative webzines by Hollywood Reporter and Ifilm.  He was also the Creative Director for Soundwalk- an award-winning collection of cutting edge walking tour cd’s.  He collaborated with powerhouses such as Puma and The Louvre Museum for the development of these visionary guides to the “nooks and crannies” of the world’s chicest cities. JD holds a degree in Graphic Design from Rhode Island School of Design and a Masters from Parsons and lives in Greenwich, CT with his wife and three children.</p>
				</li>
			</ul>
		</article>
	<?php endif; ?>
</section>
<?php }?>