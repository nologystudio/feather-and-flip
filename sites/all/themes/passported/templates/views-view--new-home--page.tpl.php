	
	<!-- Main Block -->
		
	<main id="passported-intro">
		<ul>
			<li>
				<h1 data-animate="1">
					Sophisticated family travel simplified</h1>
				</h1>
				<ul class="align-center">
					<li ng-click="goToURL('city-guides')">
						<h2 data-animate="4">Explore</h2>
						<a href="/city-guides"><h3 data-animate="5">Explore our city guides</h3></a>
					</li>
					<li ng-click="goToURL('https://go.passported.com')">
						<h2 data-animate="2">Plan</h2>
						<a href="https://go.passported.com"><h3 data-animate="3">Create your itinerary</h3></a>
					</li>
					<li ng-click="goToURL('book-hotels')">
						<h2 data-animate="6">Book</h2>
						<a href="/book-hotels"><h3 data-animate="7">Email our hotel expert</h3></a>
					</li>
				</ul>
			</li>
		</ul>
	</main>
	
	<!-- inspiration -->
	
	<section id="inspiration">
		<div class="wrapper grid-2 align-center" ng-controller="InspirationController">
			<div id="let-us-inspire" data-animate="1">
				<header>
					<h4>Find Your Perfect Trip</h4>
				</header>
				<div class="wrapper">
					<div pp-inspiration-select id="place-select" class="select" data-options="adventure|beach|city|countryside|ski">
						<header>
							<span class="icon-down-circle-full"></span>
							<h5>Pick the type of place</h5>
						</header>
					</div>
					<div pp-inspiration-select id="season-select" class="select" data-options="spring|summer|winter|fall">
						<header>
							<span class="icon-down-circle-full"></span>
							<h5>Pick a season</h5>
						</header>
					</div>
				</div>
				<button class="go-btn animated fadeIn" ng-click="submitInspiration()" ng-if="search.season && search.place">Go</button>
			</div>
		</div>
	</section>
	
	<!-- how it works -->
	
	<section id="how-it-works">
		<header>
			<h4 data-animate="1">
				Spotlight On
				<span>Itineraries & City Guides</span>
			</h4>
		</header>
		<div class="promoted-grid align-center" ng-controller="PromotedController">
			<?php $i = 0; ?>
			<?php if (isset($itineraries) && !empty($itineraries)): ?>
				<?php foreach ($itineraries as $itinerary) { ?>
					<a pp-promoted-itinerary id="<?php echo $itinerary; ?>" class="quick-entry fixed" data-animate="<?php echo $i+2; ?>"></a>
				<?php $i++; } ?>
			<?php endif; ?>
			<?php if (isset($destinations) && !empty($destinations)): ?>
				<?php foreach ($destinations as $destination) { ?>
					<a href="<?php echo $destination['url']; ?>" class="quick-entry fixed destination" data-animate="<?php echo $i+2; ?>">
						<figure>
	                        <img src="<?php echo $destination['image']['url']; ?>" alt="<?php echo $destination['image']['text']; ?>"/>
	                    </figure>
	                    <footer>
	                        <h4><?php echo $destination['title']; ?></h4>
	                    </footer>
					</a>
				<?php $i++; } ?>
			<?php endif; ?>			
		</div>
	</section>
	
	<!-- Blog -->
	
	<?php if (isset($new_travel_journal)) echo $new_travel_journal; ?>
