        <!-- Header gallery -->
        <div class="slideshow-gallery" ng-controller="SlideshowCtrl">
                <button rel="left"></button>
                <button rel="right"></button>
                <div id="slideshow-state-bar">
                        <button class="on"></button>
                        <button></button>
                </div>
                <div class="slideshow-wrapper">
                        <?php foreach($slideImages as $image){ ?>
                        <article class="slideshow-item">
                                <figure>
                                        <img src="<?php echo $image['url'];?>" alt="" data-size="<?php echo $image['tamanio'][0].'x'.$image['tamanio'][1];?>"/>
                                </figure>
                                <div class="info-wrapper">
                                        <a href="" rel="">
                                                <h1><?php if(isset($image['text'])) echo $image['text']; else echo 'city, country'; ?></h1>
                                                <span class="cursive">see hotels</span>
                                                <span class="rounded-btn">go to spain</span>
                                        </a>
                                </div>
                        </article>
                        <?php } ?>
                </div>
        </div>        
                
        <?php 
        
        /* ------------------------------------------------------------------------------------------------------------- */
        /* | i | Nav starts here... */ 
        /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ ?>
        
        <nav role="main-navigation" ng-controller="NavCtrl">
                <div class="wrapper">
                        <form id="search">
                                <input type="text" placeholder="Enter destination or hotel" value=""/>
                                <input type="submit" value=""/>
                        </form>
                        <?php print_r($main_navigation); ?>
                </div>
        </nav>