	
	
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
				<a id="blog"        href="/travel-journal" data-animate="4">travel journal</a>
				<a id="book-hotels" href="/book-hotels"    data-animate="5">book hotels</a>
				<a id="search"      class="subnav" ng-click="triggerSearch()" data-animate="6">search</a>
			</div>
			<div class="wrapper align-right">
				<a id="sign-in" href="#/sign-in" data-animate="7">Sign in</a>
				<a id="sign-up" href="#/sign-up" data-animate="8">Sign up</a>
			</div>
		</nav>
	</header>
	
	<!-- City Guide Navigation -->
	
	<?php print_r($main_navigation); ?>
		
	<div class="dropdown-wrapper">
		<div class="arrow">
			<svg>
				<path d="M 10,10 L 20,20 L 0,20 L 10,10"/>
			</svg>
		</div>
		<nav id="city-guides-list">
			<!-- Caribbean -->
			<ul>
				<li>Caribbean</li>
				<li><a href="/anguilla/city-guide">Anguilla, British West Indies</a></li>
				<li><a href="/antigua/city-guide">Antigua, West Indies</a></li>
				<li><a href="/bermuda/city-guide">Bermuda, British Territories</a></li>
				<li><a href="/harbour-island/city-guide">Harbour Island, Bahamas</a></li>
				<li><a href="/puerto-rico/city-guide">Puerto Rico, U.S.A.</a></li>
				<li><a href="/st-barths/city-guide">St. Barth's, French West Indies</a></li><
			</ul>
			<!-- Europe -->
			<ul>
				<li>Europe</li>
				<li><a href="/amsterdam/city-guide">Amsterdam, Netherlands</a></li>
				<li><a href="/barcelona/city-guide">Barcelona, Spain</a></li>
				<li><a href="/ibiza/city-guide">Ibiza, Spain</a></li>
				<li><a href="/istanbul/city-guide">Istanbul, Turkey</a></li>
				<li><a href="/london/city-guide">London, England</a></li>
				<li><a href="/mykonos/city-guide">Mykonos, Greece</a></li>
				<li><a href="/paris/city-guide">Paris, France</a></li>
				<li><a href="/reykjavik/city-guide">Reykjavik, Iceland</a></li>
				<li><a href="/rome/city-guide">Rome, Italy</a></li>
				<li><a href="/st-tropez/city-guide">St. Tropez, France</a></li>
				<li><a href="/cotswolds/city-guide">The Cotswolds, England</a></li>
				<li><a href="/venice/city-guide">Venice, Italy</a></li>
			</ul>
			<!-- North America -->
			<ul>
				<li>North America</li>
				<li><a href="/aspen/city-guide">Aspen, USA</a></li>
				<li><a href="/boston/city-guide">Boston, USA</a></li>
				<li><a href="/charleston/city-guide">Charleston, USA</a></li>
				<li><a href="/jackson-hole/city-guide">Jackson Hole, USA</a></li>
				<li><a href="/los-angeles/city-guide">Los Angeles, USA</a></li>
				<li><a href="/miami/city-guide">Miami, FL</a></li>
				<li><a href="/new-york-city/city-guide">New York City, USA</a></li>
				<li><a href="/park-city/city-guide">Park City, Utah</a></li>
				<li><a href="/punta-mita/city-guide">Punta Mita, Mexico</a></li>
				<li><a href="/san-francisco/city-guide">San Francisco, USA</a></li>
				<li><a href="/southern-standouts/city-guide">Southern Standouts, USA</a></li>
				<li><a href="/tulum-and-riviera-maya/city-guide">Tulum and Riviera Maya, Mexico</a></li>
				<li><a href="/vail/city-guide">Vail, USA</a></li>
				<li><a href="/washington-dc/city-guide">Washington DC, USA</a></li>
				<li><a href="/whistler/city-guide">Whistler, Canada </a></li>
			</ul>
			<!-- South America -->
			<ul>
				<li>South America</li>
				<li><a href="/buenos-aires/city-guide">Buenos Aires, Argentina</a></li>
				<li><a href="/cartagena/city-guide">Cartagena, Colombia</a></li>
				<li><a href="/chilean-patagonia/city-guide">Chilean Patagonia, Chile</a></li>
				<li><a href="/santiago/city-guide">Santiago, Chile</a></li></ul>
			</ul>
		</nav>
		<div id="search-block">
			<div class="wrapper">
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
			</div>
		</div>
	</div>
