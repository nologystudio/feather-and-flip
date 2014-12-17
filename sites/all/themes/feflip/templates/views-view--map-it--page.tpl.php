<?php $hideSlide = true; ?>
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
        <section id="map">
                <div class="pin" data-lat="" data-lon="">
                        <a href="" class="info">
                                <div class="wrapper">
                                        <figure>
                                                <img src="" alt=""/>
                                        </figure>
                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                </div>
                        </a>
                        <small>destination</small>
                </div>
        </section>
        <section id="weather-carrousel">
            <ul>
                <li ng-repeat="city in weatherSpots">
                    <small class="animated fadeInUp">{{city.name}}</small>
                    <div class="info animated fadeInUp">
                                <span class="icon">
                                    <img src="/sites/all/themes/feflip/media/weather/icons/{{city.weather[0].icon}}.png" alt="{{city.name}}"/>
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
                   <?php for($i=0; $i<count($destinations); $i++){ ?>
                       <li><?php echo $destinations[$i]['destination'] . '<span></span>'; if ($i === 0) {echo'<span></span>';} ?></li>
                   <?php } ?>
                   </ul>
                <?php if ($numContient == 2) { ?></div><?php } ?>
                <?php $numContient++; if($numContient >2) {$numContient = 0;} } ?>
        </section>
</section>