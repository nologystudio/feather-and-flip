<section class="static">
	<article id="about">
		<h1><?php echo $title; ?></h1>
		<?php echo (isset($body[0]) ? $body[0]['safe_value'] : ''); ?>
	</article>
	<?php if (strpos($title, 'ABOUT') !== false): // Only for 'about us' page ?>
		<article id="who-we-are">
			<h2>Who we are</h2>
			<ul>
				<li>
					<h3>HENLEY VAZQUEZ, CEO/CO-FOUNDER</h3>
					<p>Henley’s decade of experience in the travel industry includes Town & Country Travel, National Geographic Traveler, Departures, Ultratravel and Indagare. Despite her background, she found planning trips for her own family frustrating, and every parent she knew shared the same problems. Henley joined forces with the Feather+Flip team to create a website where families could easily decide where to go, where to stay, which room to reserve and what to do while they are there - all quickly bookable online. Her motto: life is too short for bad hotels. Henley lives in New York City with her husband and two children and graduated from Princeton University. Follow her at <a href="">@henleyvq.</a></p>
				</li>
				<li>
					<h3>JD BOUJNAH, CREATIVE DIRECTOR/CO-FOUNDER</h3>
					<p>JD’s award-winning designs have been featured in the New York Times, Child Magazine, Women’s Wear Daily and numerous design publications, including Tres Logos and Coast to Coast. Prior to founding Calliope Studios, JD was a driving force behind the creation of Pitch TV, rated one of the most innovative webzines by Hollywood Reporter and iFilm.  He was also the Creative Director for Soundwalk, an award-winning collection of cutting edge walking tour CDs.  He collaborated with powerhouses such as Puma and the Louvre Museum for the development of these visionary guides to the “nooks and crannies” of the world’s chicest cities. JD holds a degree in Graphic Design from Rhode Island School of Design and a Masters from Parsons and lives in Greenwich, CT with his wife and three children.</p>
				</li>
			</ul>
		</article>
	<?php endif; ?>
</section>