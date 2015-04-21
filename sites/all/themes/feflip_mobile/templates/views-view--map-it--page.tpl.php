<?php include 'slideshowandmainmenu.html.php';?>

<section id="map-it" class="full" ng-controller="MapCtrl">
        <header class="animated fadeInUp">
                <h3 class="icon compass">MAP IT</h3>
                <nav id="zoom">
                        <button rel="zoom-in"></button>
                        <button rel="zoom-out"></button>
                        <button rel="move"></button>
                </nav>
                <ul role="select">
                        <li>filter by continent</li>
                        <li>North America</li>
                        <li>South America</li>
                        <li>Caribbean</li>
                        <li>Africa</li>
                        <li>Europe</li>
                        <li>Asia</li>
                        <li>Oceania</li>
                </ul>
                <button rel="full-screen"></button>
        </header>
        <section id="map"></section>
        <section id="weather-carrousel">
            <ul>
                <li ng-repeat="city in weatherSpots">
                    <small class="animated fadeInUp">{{city.name}}</small>
                    <div class="info animated fadeInUp">
                                <span class="icon">
                                    <img src="/sites/all/themes/feflip_mobile/media/weather/icons/{{city.weather[0].icon}}.png" alt="{{city.name}}"/>
                                </span>
                        <span class="temp">{{((city.main.temp - 273.15) * 1.8 + 32) | number:0}}°F</span>
                    </div>
                </li>
            </ul>
            <button rel="left"></button>
            <button rel="right"></button>
        </section>
        <section id="hotel-list-by-continent">
                <?php $numContient = 0; foreach($destinationsbycontinent as $continent => $destinations){?>
                <?php if ($numContient == 0) { ?><div class="row"><?php } ?>
                   <ul>
                       <li><?php echo $continent;?></li>
                   <?php for($i=0; $i<count($destinations); $i++){$hotels = Hotel::GetHotelsByDestination($destinations[$i]['id']);?>
                       <li>
                           <?php
                                 $destinationTxt = $destinations[$i]['destination'];

                                 foreach($hotels as $hotel)
                                     $destinationTxt .= '<a href="'. $hotel['url'] .'"><span></span></a>';
                           
                                 echo $destinationTxt;
                           ?>
                       </li>
                   <?php } ?>
                   </ul>
                <?php if ($numContient == 2) { ?></div><?php } ?>
                <?php $numContient++; if($numContient >2) {$numContient = 0;} } ?>
        </section>
</section>