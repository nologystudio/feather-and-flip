

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
			<div id="search-destination" data-animate="1">
				<header>
					<h4 class="larger">Search a destination</h4>
				</header>
				<div class="wrapper">
					<form>
						<input type="text" class="rounded" placeholder="Enter your destination or hotel"/>
					</form>
				</div>
			</div>
			<div id="let-us-inspire"  data-animate="1">
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
	</section>
	
	<!-- how it works -->
	
	<section id="how-it-works">
		<header>
			<h4 data-animate="1">Title<span>title</span></h4>
		</header>
		<div class="promoted-grid align-center">
			<?php for($i=0;$i<6;$i++): ?>
				<a class="quick-entry" href="#" target="_blank" data-animate="<?php echo $i+2; ?>">
					<figure>
                        <img src="https://ds9464c56tfjs.cloudfront.net/styles/post_image/s3/summer_travel_giveaway.png?itok=dMMIgEwP" alt=""/>
                    </figure>
                    <footer>
                        <h4>Summer Travel Giveaway</h4>
                        <time datetime="2015-08-03 00:00">August, 2015</time>
                    </footer>
				</a>
			<?php endfor; ?>
		</div>
	</section>
	
	<!-- Map -->
	
	<section id="map" ng-controller="MapController" ng-if="">
		<div id="google-maps-container" data-animate="1"></div>
		<aside class="left" ng-class="{'on':showAside}" ng-controller="ItineraryController">
			<ul>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			<button class="aside-trigger" ng-click="openAside()" data-animate="2">
				<span>&#x23;</span>
				<svg>
					<path d="M 0,0 L 50,50 L 0,100 L 0,0"/>
				</svg>
			</button>
		</aside>
		<aside class="right" ng-class="{'on':showAside}" ng-controller="BookingController">
			<div class=""
			<button class="aside-trigger" ng-click="openAside()" data-animate="3">
				<span>&#x23;</span>
				<svg>
					<path d="M 0,0 L 50,50 L 0,100 L 0,0"/>
				</svg>
			</button>
		</aside>
	</section>
	
	
	
	<!-- Blog -->
	
	<section id="travel-journal" ng-controller="BlogController">
		<header>
			<h4 data-animate="1">Travel <span>journal</span></h4>
		</header>
		<div id="feed" class="align-center">
			<a class="quick-entry featured" href="" target="_blank" data-animate="2">
				<div class="mask">
					<figure>
                        <img src="https://ds9464c56tfjs.cloudfront.net/styles/post_image/s3/summer_travel_giveaway.png?itok=dMMIgEwP" alt=""/>
                    </figure>
                    <footer>
                        <h4>Summer Travel Giveaway</h4>
                        <time datetime="2015-08-03 00:00">August, 2015</time>
                    </footer>
				</div>
			</a>
			<div class="grid-wrapper">
				<div id="newsletter-signup" class="quick-entry" ng-controller="NewsletterController" data-animate="3">
                    <h3>Join the adventure</h3>
						<hr>
                    <h4 ng-if="currentStatus == 'still'">Sign up for our newsletter</h4>
                    <form name="newsletterForm">
                        <small id="error"   class="animated fadeInUp" ng-if="currentStatus == 'error'">We're sorry,<br>an error has occurred</small>
                        <small id="success" class="animated fadeInUp" ng-if="currentStatus == 'success'">Thanks!</small>
                        <input name="user-email" type="email" ng-if="currentStatus == 'still'" placeholder="Your email address" ng-model="signUpData.userEmail" required/>
                        <input type="submit" ng-if="currentStatus == 'still'" value="submit" ng-class="{disabled:!newsletterForm.$valid}" ng-click="!newsletterForm.$valid || regSubmit()"/>
                    </form>
            	</div>
				<a class="quick-entry review" href="http://blog.featherandflip.com/travel-journal/2014/11/25/featured-hotel-mandarin-oriental-miami" target="_blank" data-animate="4">
                    <h3> Mandarin Oriental, Miami</h3>
                    	<hr>
                    <h4>Featured Hotel</h4>
                    <time datetime="2014-11-25 15:44">November, 2014</time>
                </a>
                <a class="quick-entry" target="_blank" href="http://blog.passported.com/travel-journal/2015/8/3/summer-travel-giveaway" data-animate="5">
                    <figure>
                        <img src="https://ds9464c56tfjs.cloudfront.net/styles/post_image/s3/summer_travel_giveaway.png?itok=dMMIgEwP" alt=""/>
                    </figure>
                    <footer>
                        <h4>Summer Travel Giveaway</h4>
                        <time datetime="2015-08-03 00:00">August, 2015</time>
                    </footer>
                </a>
			</div>
		</div>
		<footer>
			<button ng-click="viewAll()">
				<span>view all</span>
				<svg>
					<path d="M 0,0 L 100,0 L 50,50 L 0,0"/>
				</svg>
			</button>
		</footer>
	</section>
	
	