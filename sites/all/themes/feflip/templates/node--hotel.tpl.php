<section id="hotel">
        <header>
                <form>
                        <label for="check-in">
                                <span>check in</span>
                                <input type="text" name="check-in" value=""/>
                        </label>
                        <label for="check-out">
                                <span>check out</span>
                                <input type="text" name="check-out" value=""/>
                        </label>
                        <label for="rooms">
                                <span>rooms</span>
                                <input type="text" name="rooms" value="" maxlength="2"/>
                        </label>
                        <label for="adults">
                                <span>adults</span>
                                <input type="text" name="adults" value="" maxlength="2"/>
                        </label>
                        <label for="children">
                                <span>children</span>
                                <input type="text" name="children" value="" maxlength="2"/>
                        </label>
                        <input type="submit" value="get rates"/>
                </form>
        </header>
        <article>
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
                                <?php for($i=0;$i<1;$i++): ?>
                                <article class="slideshow-item">
                                        <figure>
                                                <img src="http://placehold.it/1040x650" alt="City, Country" data-size="1280x800"/>
                                        </figure>
                                </article>
                                <?php endfor; ?>
                        </div>
                </div>
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
                                        <li><a href="<?php echo $node->field_hotel_url['und'][0]['value'];?>" target="_blank"><?php echo $node->field_hotel_url['und'][0]['value'];?></a></li>
                                        <?php } ?>
                                </ul>
                        </h4>
                </footer>
        </article>
        <footer></footer>
</section>