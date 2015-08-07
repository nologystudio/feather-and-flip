

	<!DOCTYPE html>
	<html ng-app="passportedApp">
		<head>
			<base href="/feather-and-flip/">
			<title>Passported</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="description" content="Passported">  
			<meta name="robots" content="noindex,nofollow">
			<!-- Icons -->
		    <link rel="icon" type="image/png" href="media/favicons/favicon-32x32.png" sizes="32x32">
		    <link rel="icon" type="image/png" href="main/media/favicons/favicon-16x16.png" sizes="16x16">
			<!-- Open Graph data -->
			<meta property="og:title"       content="">
			<meta property="og:type"        content="">
			<meta property="og:url"         content="">
			<meta property="og:image"       content="">
			<meta property="og:description" content="">
			<!-- Included Google Fonts -->
			<link href='https://fonts.googleapis.com/css?family=Lato:100,300,900' rel='stylesheet' type='text/css'>
			<!-- Less Files comes here -->
			<link rel="stylesheet/less" href="style/style-nology.less" title="style-nology" type="text/css" media="screen">
			<script type="text/javascript" src="library/vendors/less.min.js"></script>
			<!-- Modernizer and IE specyfic files -->  
			<script src="library/vendors/modernizr.custom.passported.js"></script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVp6xJDq_xg96DdjO3S1wmByGNmYoK4XQ"></script>
		</head>
		<body ng-view ng-controller="AppController">
			
			<!-- Header -->
			
			<header>
				<a href="/">
					<figure>
						<img src="/media/brand/passported-logo.png" alt="Passported, kid friendly travel for grown-ups" data-animate="1"/>
						<figcaption data-animate="2">Kid friendly travel for grown-ups</figcaption>
					</figure>
				</a>
				<nav>
					<a id="city-guides"    href="#/city-guides" data-animate="3">city guides</a>
					<a id="travel-journal" href="#/city-guides" data-animate="4">travel journal</a>
					<a id="book-hotels"    href="#/book-hotels" data-animate="5">book hotels</a>
					<a id="search"         href="#/search"      data-animate="6">search</a>
					<a id="sign-in"        href="#/sign-in"     data-animate="7">sign in</a>
					<a id="sign-up"        href="#/sign-up"     data-animate="8">sign up</a>
				</nav>
			</header>
			
			<!-- Main Block -->
			
			<main id="passported-intro">
				<ul>
					<li>
						<h1 data-animate="1">Sophisticated family travel<br>simplified</h1>
						<ul>
							<li>
								<h2 data-animate="2">Plan</h2>
								<h3 data-animate="3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</h3>
							</li>
							<li>
								<h2 data-animate="4">Explore</h2>
								<h3 data-animate="5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</h3>
							</li>
							<li>
								<h2 data-animate="6">Book</h2>
								<h3 data-animate="7">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</h3>
							</li>
						</ul>
					</li>
				</ul>
			</main>
			
			<!-- Map -->
			
			<section id="map" ng-controller="MapController">
				<header>
					<h4 data-animate="1"></h4>
				</header>
				<aside class="left"></aside>
				<div id="google-maps-container" data-animate="2"></div>
				<aside class="right" ng-controller="BookController"></aside>
				<footer></footer>
			</section>
			
			<!-- Blog -->
			
			<section id="travel-journal" ng-controller="BlogController">
				<header>
					<h4 data-animate="1">Travel Journal</h4>
				</header>
				<div class="grid-wrapper">
					<a href=""></a>	
				</div>
				<footer></footer>
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
						<img src="/media/brand/passported-black-logo.png" alt="Passported, kid friendly travel for grown-ups"/>
					</a>
					<nav id="social-media" class="black">
						<a href="https://twitter.com/Passported" target="_blank" rel="twitter"></a>
						<a href="https://www.facebook.com/featherandflip" target="_blank" rel="facebook"></a>
						<a href="http://instagram.com/featherandflip" target="_blank" rel="instagram"></a>
						<a href="http://www.pinterest.com/featherandflip" target="_blank" rel="pinterest"></a>
						<a href="https://plus.google.com/+Featherandflipkids/posts" target="_blank" rel="google-plus"></a>
					</nav>				
					<small>2015 PASSPORTED ALL RIGHTS RESERVED</small>
				</div>
			</footer>
			
			<script src="library/vendors/jquery-2.1.3.min.js"></script>
			<script src="library/vendors/moment.min.js"></script>
			<script src="library/vendors/underscore.min.js"></script>
			<script src="library/vendors/transit.min.js"></script>
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