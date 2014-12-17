<?php include 'slideshowandmainmenu.html.php';?>

<section id="start-your-journey">
        <header>
            <h3 class="simple">start your journey</h3>
        </header>
        <div id="miss-slideshow" ng-controller="SlideshowCtrl">
            <ul>
            <?php foreach($destinations as $key => $destination){ ?>
                <li>
                    <a id="destination-<?php echo $key;?>" href="<?php echo $destination['url'].'/itinerary';?>" rel="destination">
                            <figure class="circle-mask">
                                    <img src="<?php echo $destination['image']['url'];?>" alt="<?php echo $destination['destination']?>"/>
                                    <div class="border"></div>
                            </figure>
                            <h2><?php echo $destination['destination']?></h2>
                    </a>
                 </li>
                <?php } ?>
            </ul>
            <button rel="left"></button>
            <button rel="right"></button>
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
                                    <li data-image=""><span><?php echo $destination['numhotels']; ?></span><a href="<?php echo $destination['url']. '/hotel-reviews';?>"><?php echo $destination['destination']; ?></a></li>
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