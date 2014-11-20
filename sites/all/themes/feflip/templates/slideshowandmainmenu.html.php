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
                                        <img src="<?php echo $image['url'];?>" alt="" data-size="<?php echo $image['size'][0].'x'.$image['size'][1];?>"/>
                                </figure>
                                <div class="info-wrapper">
                                        <?php if( isset($image['linkto'])){ ?>
                                        <a href="<?php echo $image['linkto']; ?>" rel="">
                                                <h1><?php if(isset($image['text'])) echo $image['text']; else echo 'city, country'; ?></h1>
                                                <span class="cursive">see hotels</span>
                                                <span class="rounded-btn">go to <?php echo $image['destination']?></span>
                                        </a>
                                        <?php } else {?>
                                        <a href="">
                                        <h1><?php if(isset($image['text'])) echo $image['text']; else echo 'city, country'; ?></h1>
                                        </a>
                                        <?php }?>
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