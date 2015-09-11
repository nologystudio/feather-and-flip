	
	
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
					<a id="sign-in" href="#/sign-in" data-animate="7">Sign in</a>
					<a id="sign-up" href="#/sign-up" data-animate="8">Sign up</a>
				<?php else: ?>
					<a href="/user/logout" data-animate="7">log out</a>
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
		
		<?php print_r(get_city_guides_list()); ?>
		
		<div id="search-block">
			<div class="wrapper">
				<?php if (drupal_is_front_page()): ?>
					<div id="search-destination">
						<header>
							<h4 class="larger">Search a destination</h4>
						</header>
						<div class="wrapper">
							<form>
								<input type="text" class="rounded" placeholder="Enter your destination or hotel"/>
							</form>
						</div>
					</div>
				<?php else: ?>
					<div id="search-destination">
						<header>
							<h4 class="larger">Search a destination</h4>
						</header>
						<div class="wrapper">
							<form>
								<input type="text" class="rounded" placeholder="Enter your destination or hotel"/>
							</form>
						</div>
					</div>
					<div id="let-us-inspire">
						<header>
							<h4>Let us Inspire you</h4>
						</header>
						<div class="wrapper">
							<ul class="select">
								<li>
									<span class="icon">&#xe03a;</span>
									Pick the type of place
								</li>
							</ul>
							<ul class="select">
								<li>
									<span class="icon">&#xe03a;</span>
									Pick a season
								</li>
							</ul>
						</div>
						<button class="go-btn" ng-click="">Go</button>
						<button class="clear-btn" ng-click="">Clear</button>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
