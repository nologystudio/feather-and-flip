

	<!-- Map -->
			
	<section id="map" ng-controller="MapController">
		<div id="google-maps-container" data-animate="1"></div>
		<aside class="left" ng-class="{'on':showAside}" ng-controller="ItineraryController">
			<div class="wrapper">
		    	<ul ng-class="{'step-1':step == 1,'step-2':step == 2,'step-3':step == 3}">
				    <li id="step-1">
				    	<header>
					    	<h1>Featured destinations</h1>
					    	<h2>Lorem ipsum</h2>
				    	</header>
				    	<ul>
					    	<li ng-repeat="place in destinations">
					    		<button ng-click="displayDestination(place)" class="animated fadeIn">
						    		<figure>
						    			<img ng-src="{{place.images[0][0].src}}" alt="{{place.name}}"/>
						    		</figure>
						    		<div role="figcaption">
							    		<h2>{{place.name}}</h2>
							    		<h3 ng-bind-html="place.description"></h3>
									</div>
									<div class="right-arrow"></div>
					    		</button>
					    	</li>
				    	</ul>
				    </li>
				    <li id="step-2">
				    	<aside>
					    	<button rel="menu" ng-click="step = 2"></button>
					   		<button ng-repeat="type in selectedDestination.summaries" rel="{{type.name}}" ng-click="filterMap(type.name)" ng-class="{'on':bookFilter == type.name}"></button>
					   		<button ng-click="filterMap(undefined)" ng-class="{'on':bookFilter == undefined}" class="view-all">view all</button>
					   		<button rel="print" ng-click="printList()"></button>
				    	</aside>
				    	<div class="wrapper">
					    	<header>
						    	<figure>
						    		<img ng-src="{{pick.images[0][0].src}}"/>
						    	</figure>
						    	<h1>{{pick.name}}</h1>
						    	<nav>
							    	<a href="/city-guides/{{pick-}}"></a>
							    	<a href=""></a>
							    	<a href=""></a>
							    	<a href=""></a>
							    	<a href=""></a>
							    </nav>
					    	</header>
					    	<ul>
						    	<li id="the-trip-block">
						    		<a href="">
							    		<div class="circle-outline-icon plan-btn"></div>
							    		Plan your trip
						    		</a>
						    	</li>
						    	<li id="destination-block">
						    		<button class="circle-outline-icon download-btn"></button>
						    		<button class="circle-outline-icon share-btn"></button>
						    		<h2>{{pick.name}}, {{pick.country}}</h2>
						    		<small></small>
						    		<h3 ng-bind-html="pick.description"></h3>
						    	</li>
						    	<li id="hotel-block">
						    		<header>
							    		Section
							    		<div class="filter">
								    		<button class="radio-btn">
								    			Type<span></span>
								    		</button>
							    		</div>
						    		</header>
						    		<article>
					    				<header>
							    			<h4>Hotel name</h4>
							    			<h5>Address</h5>
							    			<p>Phone Number</p>
							    			<button>Book now</button>
						    			</header>
						    			<div class="slideshow">
							    			<ul>
								    			<li>
													<img src="" alt=""/>
												</li>
							    			</ul>
						    			</div>
						    			<p>
							    			<div class="divicer bests">Type</div>
							    			<ul>
								    			<li>Description line</li>
							    			</ul>
						    			</p>
					    			</article>
						    	</li>
					    	</ul>
				    	</div>
				    </li>
		    	</ul>
		    </div>
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