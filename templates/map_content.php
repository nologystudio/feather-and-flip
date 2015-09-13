<div id="google-maps-container" data-animate="1"></div>
<aside class="left" ng-class="{'on':showAside}" ng-controller="ItineraryController">
	<div class="wrapper">
    	<ul ng-class="{'step-1':step == 1,'step-2':step == 2,'step-3':step == 3}">
		    <li id="step-1">
		    	<header>
			    	<div class="wrapper">
				    	<h1>Featured destinations</h1>
				    	<h2>The places to know, love and book now</h2>
			    	</div>
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
							<div class="right-arrow icon-right-circle-full"></div>
			    		</button>
			    	</li>
		    	</ul>
		    </li>
		    <li id="step-2">
		    	<aside>
			    	<button rel="menu" ng-click="goTo(1)" ng-if="!cityGuideID" class="icon-back"></button>
					<button ng-repeat="type in selectedDestination.summaries" rel="{{type.name}}" ng-click="filterMap(type.name)" ng-class="{'on':bookFilter == type.name}"></button>
				</aside>
		    	<div class="wrapper" ng-if="destinationIsReady">
			    	<header>
				    	<figure>
				    		<img ng-src="{{pick.images[0][0].src}}" class="animated fadeIn"/>
				    	</figure>
				    	<h1>{{pick.name}}</h1>
			    	</header>
			    	<ul>
				    	<li id="the-trip-block">
				    		<a href="">
					    		<div class="circle-outline-icon plan-btn icon-edit"></div>
					    		Plan your trip
				    		</a>
				    	</li>
				    	<li id="destination-block">
							<nav>
						    	<a pp-social-media-link rel="facebook" class="icon-facebook-circle"></a>
						    	<a pp-social-media-link rel="twitter" class="icon-twitter-circle"></a>
						    	<a pp-social-media-link pp-social-media-image="{{pick.images[0][0].src}}" pp-social-media-desc="{{place.description}}" rel="pinterest" class="icon-pinterest-circle"></a>
						    	<a pp-social-media-link rel="instagram" class="icon-instagram-circle"></a>
						    	<a pp-social-media-link rel="google-plus" class="icon-google-circle"></a>
						    </nav>
				    		<h2>{{pick.name}}, {{pick.country}}</h2>
				    		<small>{{pick.lat}} Lat, {{pick.lon}} Lon</small>
				    		<h3 ng-bind-html="pick.description"></h3>
				    	</li>
				    	<li id="hotel-block">
				    		<header>
					    		STAY
					    		<div class="filter-wrapper">
						    		<div pp-filter filter-state="true" id="{{type}}" class="filter">
							    		<button class="radio-btn">
							    			View all<span></span>
							    		</button>
						    		</div>
						    		<div pp-filter filter-state="false" id="{{type}}" class="filter">
							    		<button class="radio-btn">
							    			Type<span></span>
							    		</button>
						    		</div>
					    		</div>
				    		</header>
				    		<article id="hotel" ng-repeat="hotel in pick.hotels">
					    		<div class="icon-hotel"></div>
			    				<header>
				    				<h4>{{hotel.name}}</h4>
					    			<h5>{{hotel.address_1}}</h5>
					    			<p><span class="icon-phone"></span>{{hotel.phone_number}}</p>
					    			<h6>{{hotel.short_description}}</h6>
					    			<button ng-click="book(hotel)">Book now<span class="icon-right-circle-full"></span></button>
				    			</header>
				    			<div pp-hotel-gallery class="slideshow">
					    			<ul>
						    			<li ng-repeat="image in hotel.images[0]">
											<img ng-src="{{image.src}}" alt=""/>
										</li>
					    			</ul>
					    			<button rel="right" class=""></button>
					    			<button rel="left" class=""></button>
				    			</div>
				    			<div id="curated" ng-repeat="content in hotel.content_blocks[0]">
					    			<div class="divider {{content.title}}">
						    			<span class="icon-{{getIcon(content.title)}}"></span>
						    			{{content.title}}
						    			<div class="line"></div>
						    		</div>
									<!-- Rich text -->
					    			<ul ng-if="check.features(content.description)">
						    			<li ng-bind-html="content.description"></li>
						    		</ul>
									<!-- Plain text -->
					    			<ul ng-if="!check.features(content.description)">
						    			<li ng-repeat="feature in content.features" ng-bind-html="feature"></li>
					    			</ul>
				    			</div>
			    			</article>
				    	</li>
				    	<li id="guide">
							<header>
					    		Section
					    		<div class="filter-wrapper">
						    		<div pp-filter filter-state="true" id="{{type}}" class="filter">
							    		<button class="radio-btn">
							    			View all<span></span>
							    		</button>
						    		</div>
						    		<div pp-filter filter-state="false" id="{{filter}}" class="filter">
							    		<button class="radio-btn">
							    			<span></span>
							    			filter
							    		</button>
						    		</div>
					    		</div>
				    		</header>
				    		<ul>
					    		<li ng-repeat="address in pick.guide">
					    			<div class="icon icon-{{getIcon(address.assoc_interests)}}"></div>
					    			<h4>{{address.title}}</h4>
					    			<h5 ng-bind-html="address.short_review"></h5>
					    			<footer>
						    			<span class="tel" ng-if="!check.phone(address.phone_number)">{{address.phone_number}}</span>
						    			<a href="" ng-if="">read more</a>
					    			</footer>
					    		</li>
				    		</ul>
						</li>
			    	</ul>
		    	</div>
		    </li>
    	</ul>

    </div>
	<button class="aside-trigger" ng-click="openAside()" data-animate="2">
		<span class="icon-arrow-right"></span>
		<svg>
			<path d="M 0,0 L 50,50 L 0,100 L 0,0"/>
		</svg>
	</button>
</aside>
<aside class="right" ng-controller="BookingController" ng-class="{'on':showRightAside}">
	<div class="wrapper">
		<div class="error" ng-if="error" class="animated fadeInDown">
			<span>{{error}}</span>
		</div>
		<button class="icon-close" ng-click="openAside()"></button>
    	<ul>
		    <li id="step-1">
				<header>
			    	<div class="wrapper">
				    	<h1>Contact us</h1>
				    	<h2>Consult our hotel experts</h2>
				    	<div class="destination-hotel-wrapper" ng-if="booking.destination && booking.hotel">
					    	<h3>{{booking.destination}}</h3>
				    		<h4>{{booking.hotel}}</h4>
				    	</div>
			    	</div>
		    	</header>
		    	<ul>
			    	<li id="booking-message">
			    		<h5>Great! Thank you. One of our trip planners will be in touch soon.</h5>
			    	</li>
			    	<li id="email-entry">
			    		Drop us an e-mail or fill out the form below
			    		<a href="/contact" class="icon circle-btn icon-email" target="_blank"></a>
			    	</li>
			    	<li>
			    		<form name="bookingForm">
				    		<ul>
					    		<li>
					    			<div id="date-picker">
						    			<button class="rounded-btn icon-calendar">{{booking.start_date ? booking.start_date : "Start Date"}}</button>
						    			<button class="rounded-btn icon-calendar">{{booking.start_date ? booking.end_date : "End Date"}}</button>
					    			</div>
					    			<div id="calendar" class="animated fadeIn" ng-if="showCalendar" ng-controller="CalendarController">
										<div id="arrival-gallery" class="gallery-wrapper">
											<ul id="arrival" class="month-gallery">
												<li id="month-{{$index}}" class="month-container" ng-repeat="month in year">
													<header>
														<div class="month-title">{{month.name}}</div>
														<small>mon</small>
														<small>tue</small>
														<small>wed</small>
														<small>thu</small>
														<small>fri</small>
														<small>sat</small>
														<small>sun</small>
													</header>
													<button ng-if="$index < month.order.start" ng-repeat="day in month.order.days" class="hidden"></button>
													<button ng-repeat="(key,day) in month.order.days" data-date="{{day}}" class="arrival">{{key}}</button>
												</li>
											</ul>
											<header>
												<h6>Choose your arrival date</h6>
												<nav>
													<button rel="prev" class="icon-left-circle-full"></button>
													<small></small>
													<button rel="next" class="icon-right-circle-full"></button>
												</nav>
											</header>
										</div>
										<div id="departure-gallery" class="gallery-wrapper">
											<ul id="departure" class="month-gallery">
												<li id="month-{{$index}}" class="month-container" ng-repeat="month in year">
													<header>
														<div class="month-title">{{month.name}}</div>
														<small>mon</small>
														<small>tue</small>
														<small>wed</small>
														<small>thu</small>
														<small>fri</small>
														<small>sat</small>
														<small>sun</small>
													</header>
													<button ng-if="$index < month.order.start" ng-repeat="day in month.order.days" class="hidden"></button>
													<button ng-repeat="(key,day) in month.order.days" data-date="{{day}}" class="departure">{{key}}</button>
												</li>
											</ul>
											<header>
												<h6>Choose your departure date</h6>
												<nav>
													<button rel="prev" class="icon-left-circle-full"></button>
													<small></small>
													<button rel="next" class="icon-right-circle-full"></button>
												</nav>
											</header>
										</div>
									</div>
					    		</li>
					    		<li>
					    			<label>Number of Adults</label>
					    			<div class="circle-input-wrapper">
					    				<input type="text" ng-model="booking.adults" ng-pattern="/^[0-9]+$/" maxlength="1" required/>
					    			</div>
					    		</li>
					    		<li>
					    			<label>Number of Children</label>
					    			<div class="circle-input-wrapper">
					    				<input type="text" ng-model="booking.children" ng-pattern="/^[0-9]+$/" maxlength="1"/>
					    			</div>
					    		</li>
					    		<li>
					    			<label>Budget per Night<label>
					    			<div class="budget-check" ng-click="setter.budget('400$-800$')">
						    			400$-800$
						    			<span></span>
					    			</div>
					    			<div class="budget-check" ng-click="setter.budget('800$-1200$')">
						    			800$-1200$
						    			<span></span>
					    			</div>
					    			<div class="budget-check" ng-click="setter.budget('1200$+')">
						    			1200$+
						    			<span></span>
					    			</div>
					    			<input type="text" class="rounded" placeholder="other" ng-model="booking.specific_budget"/>
					    		</li>
					    		<li class="add-border">
					    			<div class="half-wrapper">
					    				<label for="user-name" class="clear">Name</label>
										<input id="user-name" type="text" class="rounded" ng-model="booking.name" required/>
					    			</div>
					    			<div class="half-wrapper">
					    				<label for="user-last" class="clear">Last Name</label>
										<input id="user-last" type="text" class="rounded" ng-model="booking.last" required/>
					    			</div>
					    			<label for="user-email" class="clear">Email</label>
					    			<input id="user-email" type="email" class="rounded" ng-model="booking.email" ng-pattern="/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/" required/>
					    		</li>
					    		<li>
					    			<textarea placeholder="Prefer connecting rooms or a suite? Any favorite hotels will help us pick your perfect match for this trip. Let us know here." ng-model="booking.message" required/></textarea>
					    		</li>
					    		<li>
					    			<button id="submit" class="rounded-btn" ng-class="{'off':!bookingForm.$valid}" ng-click="submit()">send</button>
					    		</li>
				    		</ul>
			    		</form>
			    	</li>
		    	</ul>
		    </li>
    	</ul>
	</div>
</aside>