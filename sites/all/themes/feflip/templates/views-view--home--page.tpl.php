<?php include 'slideshowandmainmenu.html.php';?>

<section id="start-your-journey">
        <header><h3 class="simple">start your journey</h3></header>
        <div class="gallery-wrapper">
                <?php foreach($destinations as $destination){ ?>
                <a href="<?php echo $destination['url'].'/itinerary';?>" rel="destination" class="gallery-item">
                        <figure class="circle-mask">
                                <img src="<?php echo $destination['image'];?>" alt=""/>
                                <div class="border"></div>
                        </figure>
                        <h2><?php echo $destination['destination']?></h2>
                </a>
                <?php } ?>
        </div>
        <footer>
                <a href="" class="section-button"></a>
        </footer>
</section>
<!-- | i | Booking engine: Landing ------------------------------------------------------- -->
<section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="booking"></section>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - -  -->
<section id="map-it" ng-controller="MapCtrl">
        <header>
                <h3 class="icon compass">MAP IT<span> where to go now </span></h3>
        </header>
        <aside>
                <nav>
                        <div class="tab" ng-click="displayMenu()"></div>
                        <ul>
                                <li data-image=""><span>hotels</span>destination</li>
                                <?php foreach($destinations as $destination){ ?>
                                    <li data-image=""><span><?php echo $destination['numhotels']; ?></span><?php echo $destination['destination']; ?></li>
                                <?php } ?>
                        </ul>
                        <figure>
                                <img src="" alt=""/>
                        </figure>
                </nav>
        </aside>
        <div id="map">
                <div class="pin" ng-repeat="destination in destinations">
                        <a href="{{destination.url}}" class="info">
                                <div class="wrapper">
                                        <figure>
                                                <img src="{{destination.image}}"/>
                                        </figure>
                                        <p></p>
                                </div>
                        </a>
                        <small>{{destination.withcountry}}</small>
                </div>
        </div>
        <footer>
                <a href="" class="section-button"></a>
        </footer>
</section>
<?php
    // Print Travel journal section
    echo $travel_journal; ?> 