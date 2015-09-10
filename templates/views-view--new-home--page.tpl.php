	
	
	<!-- Main Block -->
		
	<main id="passported-intro">
		<ul>
			<li>
				<h1 data-animate="1">Sophisticated family travel simplified</h1>
				<ul class="align-center">
					<li ng-click="goTo('plan')">
						<h2 data-animate="2">Plan</h2>
						<h3 data-animate="3">Find the ideal destination and hotel for your particular FAMILY needs</h3>
					</li>
					<li ng-click="goTo('explore')">
						<h2 data-animate="4">Explore</h2>
						<h3 data-animate="5">Parent-scouted picks and itineraries that you can customize</h3>
					</li>
					<li ng-click="goTo('book')">
						<h2 data-animate="6">Book</h2>
						<h3 data-animate="7">We book your hotel. You can call or e-mail our hotel expert</h3>
					</li>
				</ul>
			</li>
		</ul>
	</main>
	
	<!-- inspiration -->
	
	<section id="inspiration">
		<div class="wrapper grid-2 align-center">
			<div id="let-us-inspire"  data-animate="1">
				<header>
					<h4>Let us Inspire you</h4>
				</header>
				<div class="wrapper">
					<ul class="select">
						<li>
							<span class="icon icon-down-circle-full">&#xe03a;</span>
							Pick the type of place
						</li>
					</ul>
					<ul class="select">
						<li>
							<span class="icon icon-down-circle-full"></span>
							Pick a season
						</li>
					</ul>
				</div>
				<!-- 
				<button class="go-btn" ng-click="">Go</button>
				<button class="clear-btn" ng-click="">Clear</button> 
				-->
			</div>
		</div>
	</section>
	
	<!-- how it works -->
	
	<section id="how-it-works">
		<header>
			<h4 data-animate="1">
				Spotlight 
				<span>On</span>
			</h4>
		</header>
		<div class="promoted-grid align-center">
			<?php $i = 0; ?>
			<?php if (isset($itineraries) && !empty($itineraries)): ?>
				<?php foreach ($itineraries as $itinerary) { ?>
					<a data-id="<?php echo $itinerary; ?>" data-animate="<?php echo $i+2; ?>">
						<figure>
	                        <img />
	                    </figure>
	                    <footer>
	                        <h4></h4>
	                        <time></time>
	                    </footer>
					</a>
				<?php $i++; } ?>
			<?php endif; ?>
			<?php if (isset($destinations) && !empty($destinations)): ?>
				<?php foreach ($destinations as $destination) { ?>
					<a class="quick-entry" href="<?php echo $destination['url']; ?>" data-animate="<?php echo $i+2; ?>">
						<figure>
	                        <img src="<?php echo $destination['image']['url']; ?>" alt="<?php echo $destination['image']['text']; ?>"/>
	                    </figure>
	                    <footer>
	                        <h4><?php echo $destination['title']; ?></h4>
	                        <time datetime="<?php echo $destination['date_raw']; ?>"><?php echo $destination['date']; ?></time>
	                    </footer>
					</a>
				<?php $i++; } ?>
			<?php endif; ?>			
		</div>
	</section>
	
	<!-- Blog -->
	
	<?php if (isset($new_travel_journal)) echo $new_travel_journal; ?>
