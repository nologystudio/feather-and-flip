	
	
	<!-- Main Block -->
		
	<main id="passported-intro">
		<ul>
			<li>
				<h1 data-animate="1">Sophisticated family travel simplified</h1>
				<ul class="align-center">
					<li ng-click="goTo('plan')">
						<h2 data-animate="2">Plan</h2>
						<a href="/city-guides"><h3 data-animate="3">Find the ideal destination and hotel for your particular FAMILY needs</h3></a>
					</li>
					<li ng-click="goTo('explore')">
						<h2 data-animate="4">Explore</h2>
						<a href="https://go.passported.com"><h3 data-animate="5">Parent-scouted picks and itineraries that you can customize</h3></a>
					</li>
					<li ng-click="goTo('book')">
						<h2 data-animate="6">Book</h2>
						<a href="/book"><h3 data-animate="7">We book your hotel. You can call or e-mail our hotel expert</h3></a>
					</li>
				</ul>
			</li>
		</ul>
	</main>
	
	<!-- inspiration -->
	
	<section id="inspiration">
		<div class="wrapper grid-2 align-center">
			<div id="let-us-inspire" data-animate="1">
				<header>
					<h4>Let us Inspire you</h4>
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
				Spotlight 
				<span>On</span>
			</h4>
		</header>
		<div class="promoted-grid align-center" ng-controller="PromotedController">
			<?php $i = 0; ?>
			<?php if (isset($itineraries) && !empty($itineraries)): ?>
				<?php foreach ($itineraries as $itinerary) { ?>
					<a pp-promoted-itinerary id="<?php echo $itinerary; ?>" data-animate="<?php echo $i+2; ?>"></a>
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
	
	<!-- newsletter -->
	
	<section id="newsletter" ng-controller="NewsletterController">
		<div class="wrapper">
			<header>
				<h4 data-animate="1">Join the adventure<span>Sign up for our newsletter</span></h4>
			</header>
			<form name="newsletterForm" data-animate="2">
                <small id="error"   class="animated fadeInUp" ng-if="currentStatus == 'error'">We're sorry, an error has occurred</small>
                <small id="success" class="animated fadeInUp" ng-if="currentStatus == 'success'">Thanks!</small>
                <input name="user-email" class="rounded" type="email" ng-if="currentStatus == 'still'" placeholder="Your email address" ng-model="signUpData.userEmail" required/>
                <button class="go-btn" ng-if="currentStatus == 'still'" ng-class="{disabled:!newsletterForm.$valid}" ng-click="!newsletterForm.$valid || regSubmit()">GO</button>
            </form>
		</div>
	</section>
	
	<!-- Blog -->
	
	<?php if (isset($new_travel_journal)) echo $new_travel_journal; ?>
