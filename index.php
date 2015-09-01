

	<!DOCTYPE html>
	<html ng-app="ppApp" class="no-js">
		<head>
			<base href="/feather-and-flip/">
			<title>Passported</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="description" content="Passported">  
			<meta name="robots" content="noindex,nofollow">
			<!-- Icons -->
		    <link rel="icon" type="image/png" href="media/favicons/passported-favicon-64x64.png" sizes="64x64">
		    <link rel="icon" type="image/png" href="media/favicons/passported-favicon-32x32.png" sizes="32x32">
		    <link rel="icon" type="image/png" href="main/media/favicons/passported-favicon-16x16.png" sizes="16x16">
			<!-- Open Graph data -->
			<meta property="og:title"       content="">
			<meta property="og:type"        content="">
			<meta property="og:url"         content="">
			<meta property="og:image"       content="">
			<meta property="og:description" content="">
			<!-- Included Google Fonts -->
			<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
			<!-- Less Files comes here -->
			<link rel="stylesheet" href="style/style-nology.css" title="style-nology" type="text/css" media="screen">
			<!-- Modernizer and IE specyfic files -->  
			<script src="library/vendors/modernizr.custom.pp.js"></script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVp6xJDq_xg96DdjO3S1wmByGNmYoK4XQ"></script>
		</head>
		<body ng-controller="AppController">
			
			<!-- Header -->
			
			<header>
				<a href="/">
					<figure>
						<img src="/feather-and-flip/media/brand/passported-logo.svg" type="image/svg+xml" alt="Passported, kid friendly travel for grown-ups" data-animate="1"/> 						
						<figcaption data-animate="2">Kid friendly travel for grown-ups</figcaption>
					</figure>
				</a>
				<nav>
					<div class="wrapper align-center">
						<a id="city-guides" href="#/city-guides"    class="subnav" data-animate="3">city guides</a>
						<a id="blog"        href="#/travel-journal" data-animate="4">travel journal</a>
						<a id="book-hotels" href="#/book-hotels"    data-animate="5">book hotels</a>
						<a id="search"      href="#/search"         class="subnav" data-animate="6">search</a>
					</div>
					<div class="wrapper align-right">
						<a id="sign-in" href="#/sign-in" data-animate="7">Sign in</a>
						<a id="sign-up" href="#/sign-up" data-animate="8">Sign up</a>
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
					
				</div>
			</div>
			
			<!-- Main Block -->
			
			<!-- Main Block -->
		
			<main id="passported-intro">
				<ul>
					<li>
						<h1 data-animate="1">Sophisticated family travel<br>simplified</h1>
						<ul class="align-center">
							<li ng-click="goTo('plan')">
								<h2 data-animate="2">Plan</h2>
								<h3 data-animate="3">We help you find the ideal destination and hotel for your particular FAMILY needs</h3>
							</li>
							<li ng-click="goTo('explore')">
								<h2 data-animate="4">Explore</h2>
								<h3 data-animate="5">We have parent-scouted picks and itineraries that you can customize</h3>
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
			
			<!-- Press -->
			
			<section id="press">
				<ul class="logo-gallery">
                    <li>
                    	<figure id="" data-animate="1">
                        	<img src="" alt=""/>
						</figure>
                    </li>
                </ul>
            </section>
			
			<!-- Footer -->
			
			<footer>
				<nav>
					<ul>
						<li>
							<span class="icon destinations"></span>
							Destinations
						</li>
						<li><a href=""></a></li>
					</ul>
					<ul>
						<li>
							<span class="icon popular"></span>
							Popular Hotels
						</li>
						<li><a href=""></a></li>
					</ul>
					<ul>
						<li>
							<span class="icon passported"></span>
							Passported
						</li>
						<li><a href=""></a></li>
					</ul>
				</nav>
				<div class="fixed-bar">
					<a id="brand" href="/">
						<img src="/feather-and-flip/media/brand/passported-black-logo.svg" type="image/svg+xml" alt="Passported, kid friendly travel for grown-ups"/>
					</a>
					<nav id="social-media" class="black">
						<a href="https://twitter.com/passported" target="_blank" rel="twitter"></a>
						<a href="https://www.facebook.com/getpassported" target="_blank" rel="facebook"></a>
						<a href="http://instagram.com/getpassported" target="_blank" rel="instagram"></a>
						<a href="http://www.pinterest.com/passported" target="_blank" rel="pinterest"></a>
					</nav>			
					<small>2015 PASSPORTED ALL RIGHTS RESERVED</small>
				</div>
			</footer>
			
			<script src="library/vendors/jquery-2.1.3.min.js"></script>
			<script src="library/vendors/moment.min.js"></script>
			<script src="library/vendors/underscore.min.js"></script>
			<script src="library/vendors/transit.min.js"></script>
			<script src="library/vendors/imagesloaded.min.js"></script>
			<script src="library/vendors/retina.min.js"></script>
			<script src="library/vendors/waypoints.min.js"></script>
			
			<script src="library/vendors/angular.min.js"></script>
			<script src="library/vendors/angular-cookies.min.js"></script>
			<script src="library/vendors/angular-sanitize.min.js"></script>
			<script src="library/vendors/angular-route.min.js"></script>
			<script src="library/vendors/angular-resource.min.js"></script>
			
			<script src="library/pp-directives.js"></script>
			<script src="library/pp-controllers.js"></script>
			<script src="library/pp-app.js"></script>
		</body>
	</html>