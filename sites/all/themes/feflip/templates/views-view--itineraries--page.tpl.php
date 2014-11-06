<section id="itinerary">
        <header>
                <ul>
                        <li><button rel="sleep">sleep</button></li>
                        <li><button rel="eat">eat</button></li>
                        <li id="destination">
                                <figure>
                                        <div class="mask">
                                                <img src="http://placehold.it/100x100" alt=""/>
                                        </div>
                                        <figcaption><?php echo $itinerary['destination'];?></figcaption>
                                </figure>
                                <small>
                                        <div id="current-time">3:00 AM</div>
                                        <div id="weather">25¼F<span></span></div>
                                </small>
                        </li>
                        <li><button rel="play">play</button></li>
                        <li><button rel="noteworthy">noteworthy</button></li>
                </ul>
        </header>
        <div class="wrapper">
                <article id="itinerary-guide">
                        <h2 class="middle-line">Itinerary Guide</h2>
                        <h3><?php echo $itinerary['description'];?></h3>
                        <!-- Gallery starts here -->
                        <div class="slideshow-gallery" ng-controller="SlideshowCtrl">
                                <button rel="left"></button>
                                <button rel="right"></button>
                                <div id="slideshow-state-bar">
                                        <button class="on"></button>
                                        <button></button>
                                </div>
                                <div class="slideshow-wrapper">
                                        <?php for($i=0;$i<1;$i++): ?>
                                        <article class="slideshow-item">
                                                <figure>
                                                        <img src="http://placehold.it/1040x650" alt="City, Country" data-size="1280x800"/>
                                                </figure>
                                        </article>
                                        <?php endfor; ?>
                                </div>
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
        <footer></footer>
</section>   