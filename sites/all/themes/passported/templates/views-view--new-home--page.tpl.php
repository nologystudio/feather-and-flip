	
	<!-- Main Block -->
	<main id="passported-home" class="full">
        <?php if (isset($top_gallery)) echo $top_gallery; ?>
	</main>
	<!-- Search & Newsletter -->
    <section id="search-and-newsletter" class="full">
        <div class="wrapper">
            <div id="find-your-trip" class="half" ng-controller="InspirationController">
                <header>
                    <h4>We'll Plan Your Perfect Trip</h4>
                </header>
                <div class="select-wrapper">
	                <div pp-inspiration-select id="place-select" class="select" data-options="adventure|beach|city|countryside|ski">
	                    <header>
	                        <span class="icon-down-circle-full"></span>
	                        <h5>Type of place</h5>
	                    </header>
	                </div>
	                <div pp-inspiration-select id="season-select" class="select" data-options="spring|summer|winter|fall">
	                    <header>
	                        <span class="icon-down-circle-full"></span>
	                        <h5>Season</h5>
	                    </header>
	                </div>
	                <button class="go-btn animated fadeIn" ng-click="submitInspiration()" ng-if="search.season && search.place">Go</button>
                </div>
            </div>
            <div class="vertical-line-divider"></div>
            <div id="newsletter-cta" class="half" ng-controller="NewsletterController">
                <form id="newsletter-form" name="newsletterForm">
                    <header>
                        <h4>Sign Up to Our Newsletter</h4>
                        <span ng-if="newsStatus == 'error'" class="animated fadeInDown">We're sorry, an error has occurred</span>
                    </header>
                    <div class="wrapper">
                        <h3 ng-if="newsStatus == 'success'" class="animated fadeInDown">Thanks!</h3>
                        <input name="user-email" class="full rounded" type="email" ng-if="newsStatus != 'success'" placeholder="Your email address" ng-model="data.userEmail" required/>
                    </div>
                    <input type="submit" value="submit" ng-class="{disabled:!newsletterForm.$valid}" ng-click="!newsletterForm.$valid || regNewsletter()" ng-if="newsStatus == '' || newStatus == 'error'"/>
                </form>
            </div>
        </div>
    </section>
	<!-- Blog -->
	<?php if (isset($new_travel_journal)) echo $new_travel_journal; ?>
    <!-- Instagram -->
    <section id="instagram-feed" class="full" ng-controller="SocialFeedController">
        <div class="wrapper">
            <header>
                <h3>#getpassported</h3>
            </header>
            <div class="gallery-wrapper" ui-gallery>
                <ul>
                    <li ng-repeat="post in instagram">
                        <a href="{{post.link}}" target="_blank">
                            <img ng-src="{{post.images.standard_resolution.url}}"/>
                        </a>
                    </li>
                </ul>
                <button rel="left">
                    <svg width="40" height="80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use x="0" y="0" xlink:href="#left-arrow"/>
                    </svg>
                    <span></span>
                </button>
                <button rel="right">
                    <svg width="40" height="80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use x="0" y="0" xlink:href="#right-arrow"/>
                    </svg>
                    <span></span>
                </button>
            </div>
            <div id="plan-banner">
                <figure>
                    <img src="<?php echo drupal_get_path('theme','passported'); ?>/media/backgrounds/plan-your-next-trip.jpg" alt="Plan your next trip with Passported"/>
                </figure>
                <div class="vertical-wrapper">
                    <h4>Plan your next trip with Passported</h4>
                    <a href="https://go.passported.com/" class="rounded-btn white">Start your itinerary</a>
                </div>
            </div>
        </div>
    </section>
