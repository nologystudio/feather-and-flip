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
                <?php foreach($destinations as $destination){ ?>
                <div class="destination">
                        <small><?php echo $destination['destination'];?></small>
                        <div class="info animated fadeInUp">
                                <span class="icon">1</span>
                                <span class="temp">60¡F</span>
                        </div>
                </div>
                <?php } ?>
        </section>
        <section id="hotel-list-by-continent">
                <div class="row">
                <?php foreach($destinationsbycontinent as $continent => $destinations){?>
                   <ul>
                       <li><?php echo $continent;?></li>
                   <?php for($i=0; $i<count($destinations); $i++){ ?>
                       <li><?php echo $destinations[$i]['destination'] . '<span></span>'; if ($i === 0) {echo'<span></span>';} ?></li>
                   <?php } ?>
                   </ul>
                <?php } ?>
                </div>
        </section>
</section>