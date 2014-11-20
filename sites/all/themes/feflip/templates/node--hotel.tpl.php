<?php include 'slideshowandmainmenu.html.php';?>

<section id="hotel">
        <header>
            <form id="booking-search" ng-controller="BookingEngineCtrl" ng-include="searchTpl"></form>
        </header>
        <article id="detail">
                <header>
                        <a href="<?php echo $hotelreviews;?>" rel="all">view all hotels in destination</a>
                        <h1 class="middle-line"><?php echo $node->title;?></h1>
                        <a href="<?php echo $previous;?>" rel="prev">previous hotel</a>
                        <a href="<?php echo $next;?>" rel="next">next hotel</a>
                        <div id="category">
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                        </div>
                </header>
                <!-- Gallery starts here -->
                <div class="slideshow-gallery" ng-controller="SlideshowCtrl">
                        <button rel="left"></button>
                        <button rel="right"></button>
                        <div id="slideshow-state-bar">
                                <button class="on"></button>
                                <button></button>
                        </div>
                        <div class="slideshow-wrapper">
                                <?php foreach($images as $image){ ?>
                                <article class="slideshow-item">
                                        <figure>
                                                <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt']?>" data-size="<?php echo $image['size'][0].'x'.$image['size'][1];?>"/>
                                        </figure>
                                </article>
                                <?php } ?>
                        </div>
                </div>
        </article>
        
        <!-- | i | Booking engine: Room detail --------------------------------------------------- -->
        <section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="booking"></section>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - -  - - - -  -  -->        
        
        <article id="features">
                <!-- Features -->
                <?php foreach($features as $obj){?>
                <ul class="row">
                    <?php foreach($obj as $contentblock) {?>
                        <li>
                                <ul>
                                        <li><?php echo $contentblock['title'] ?></li>
                                         <?php $i=1; foreach($contentblock['features'] as $feature) {?>
                                            <li><span><?php echo $i++.'.'; ?></span><?php echo $feature; ?></li>
                                         <?php } ?>
                                </ul>
                        </li>
                    <?php } ?>    
                </ul>
                <?php } ?>
                
                <footer>
                        <h3 class="middle-line">Info</h3>
                        <h4>
                                <ul>
                                        <?php if(count($node->field_adress_1) == 1){ ?>
                                        <li><?php echo $node->field_adress_1['und'][0]['value'];?></li>
                                        
                                        <?php } if(count($node->field_adress_2) == 1){ ?>
                                        <li><?php echo $node->field_adress_2['und'][0]['value'];?></li>
                                        
                                        <?php } if(count($node->field_phone_number) == 1){ ?>
                                        <li><?php echo $node->field_phone_number['und'][0]['value'];?></li>
                                        
                                        <?php } if(count($node->field_hotel_url) == 1){ ?>
                                        <li><a href="<?php echo 'http://'.$node->field_hotel_url['und'][0]['value'];?>" target="_blank"><?php echo $node->field_hotel_url['und'][0]['value'];?></a></li>
                                        <?php } ?>
                                </ul>
                        </h4>
                </footer>
        </article>
        <footer>
                <a href="#" rel="terms-and-conditions"></a>
                <a href="#" rel="map"></a>
                <a href="#" rel="tripadvisor"></a>
        </footer>
</section>