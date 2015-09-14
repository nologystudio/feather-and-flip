	
	
	<!-- Header -->
				
	<header>
		<a href="/">
			<figure>
				<img src="<?php echo drupal_get_path('theme', 'passported'); ?>/media/brand/passported-logo.svg" type="image/svg+xml" alt="Passported, kid friendly travel for grown-ups" data-animate="1"/> 								
				<figcaption data-animate="2">Kid friendly travel for grown-ups</figcaption>
			</figure>
		</a>
		<nav>
			<div class="wrapper align-center">
				<a id="city-guides" href="/city-guides"    class="subnav" data-animate="3">city guides</a>
				<a id="blog"        href="http://blog.passported.com" data-animate="4" target="_blank">travel journal</a>
				<a id="book-hotels" href="/book-hotels"    data-animate="5">book hotels</a>
				<a id="search"      class="subnav" ng-click="triggerSearch()" data-animate="6">search</a>
			</div>
			<div class="wrapper align-right">
				<?php if (!user_is_logged_in()): ?>
					<a id="sign-in" href="/sign-in" data-animate="7">Sign in</a>
					<a id="sign-up" href="/sign-up" data-animate="8">Sign up</a>
				<?php else: ?>
					<?php global $user; ?>
					<a id="sign-out" href="/user/logout" data-animate="7">Sign out</a>
					<a id="user" href="https://go.passported.com/user/voyages" data-animate="8"><?php echo $user->name; ?></a>
				<?php endif; ?>
			</div>
		</nav>
	</header>
	
	<!-- City Guide Navigation -->
		
	<div class="dropdown-wrapper">
		<div class="arrow">
			<svg>
				<path d="M 10,10 L 20,20 L 0,20 L 10,10"/>
			</svg>
		</div>
		
		<?php print_r(pp_get_city_guides_list()); ?>
		
		<div id="search-block" class="<?php if(drupal_is_front_page()) echo 'single-search' ?>">
			<div class="wrapper">
				<div id="search-destination" ng-controller="SearchController">
					<header>
						<h4 class="larger">Search a destination</h4>
					</header>
					<div class="wrapper">
						<form>
							<span class="icon-search"></span>
							<input type="text" class="rounded" ng-model="userSearch" ng-change="searchSubmit()" placeholder="Enter your destination"/>
						</form>
					</div>
					<ul id="search-result" ng-if="showResult" class="animated fadeIn">
						<li id="contact-us" class="title">
							<a href="/contact">Don't see what you are looking for?<br>Contact our team for help<span class="icon-right-circle-full"></span></a>
						</li>
						<div class="result-wrapper" ng-if="destinations.length > 0">
							<li class="title">Destinations</li>
							<li ng-repeat="destination in destinations">
								<a href="{{destination.guide_url}}">{{destination.title}}</a>
							</li>
						</div>
						<div class="result-wrapper" ng-if="hotels.length > 0">
							<li class="title">Hotels</li>
							<li ng-repeat="hotel in hotels">
								<a href="{{hotel.guide_url}}">{{hotel.title}}</a>
							</li>
						</div>
					</ul>
				</div>
				<?php if(!drupal_is_front_page()): ?>
					<div id="let-us-inspire" data-animate="1" ng-controller="InspirationController">
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
				<?php endif; ?>
			</div>
		</div>
	</div>
