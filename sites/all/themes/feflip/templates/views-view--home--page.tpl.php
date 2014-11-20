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
        </div>
        <footer>
                <a href="" class="section-button"></a>
        </footer>
</section>
<?php
    // Print Travel journal section
    echo $travel_journal; ?> 