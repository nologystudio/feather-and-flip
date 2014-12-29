<?php include 'slideshowandmainmenu.html.php';?>

<section id="itinerary" ng-controller="ItineraryCtrl">
        <header>
                <ul>
                        <li><button rel="eat">eat</button></li>
<li><button rel="play">play</button></li>
                        
                        <li id="destination">
                                <figure>
                                        <div class="mask">
                                                <img src="<?php echo (isset($slideImages) && isset($slideImages[0])) ? $slideImages[0]['marble'] : 'http://placehold.it/100x100'; ?>" alt=""/>
                                        </div>
                                        <figcaption><?php echo $itinerary['destination'];?></figcaption>
                                </figure>
                                <small>
                                        <div id="current-time">3:00 AM</div>
                                        <div id="weather" data-weatherId="<?php echo $weather_id; ?>">25�F<span></span></div>
                                </small>
                        </li>
                        
						<li><button rel="shop">shop</button></li>
                        <li><button rel="noteworthy">noteworthy</button></li>
                </ul>
        </header>
        <div class="wrapper">
                <article id="itinerary-guide">
                    <h2 class="middle-line">Itinerary Guide</h2>
                    <h3><?php echo $itinerary['description'];?></h3>
                    <!-- Gallery starts here -->
					<div id="itinerary-gallery" class="one-item" ng-controller="SlideshowCtrl">
                		<ul>
						<?php foreach($itinerary['images'] as $image){ ?>
                        <li>
                            <article>
                                <figure>
                                    <img src="<?php echo $image['url'];?>" alt=""/>
                                </figure>
                            </article>
                        </li>
						<?php } ?>
                		</ul>
						<button rel="left"></button>
						<button rel="right"></button>
            		</div> 
                </article>
                <article id="neighborhood-guide">
                        <h2 class="middle-line"><?php echo $itinerary['name'];?></h2>
                        <ul>
                                <?php foreach($itinerary['routes'] as $route){ ?>
                                <li>
                                        <figure>
                                                <img src="<?php echo $route['image'];?>" alt=""/>
                                        </figure>
                                        <div>
                                                <h4><?php echo $route['name'];?></h4>
                                                <h5><?php echo $route['description'];?></h5>
                                        </div>
                                </li>
                                <?php } ?>
                        </ul>
                </article>
        </div>
       <footer>
				<button rel="see-hotel-reviews">Go to Hotel Reviews</button>
			</footer>
</section>
<?php if (isset($hotels)) print $hotels; ?>
<?php if (isset($travel_journal)) print $travel_journal; ?>