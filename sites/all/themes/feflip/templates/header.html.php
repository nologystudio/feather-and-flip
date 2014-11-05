      <?php 
        
        /* ------------------------------------------------------------------------------------------------------------- */
        /* | i | Header starts here... */ 
        /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ ?>
        
        <header>
                <a id="brand" href=""><img src="<?php echo variable_get('relativePath'); ?>media/brand/feather-and-flip-white-logo.png" alt="Feather+flip"/></a>
                <nav id="social-media" class="white">
                        <a href="#" rel="twitter"></a>
                        <a href="#" rel="facebook"></a>
                        <a href="#" rel="instagram"></a>
                        <a href="#" rel="pinterest"></a>
                        <a href="#" rel="google-plus"></a>
                </nav>
                <!-- Header gallery -->
                <div class="slideshow-gallery" ng-controller="SlideshowCtrl">
                        <button rel="left"></button>
                        <button rel="right"></button>
                        <div id="slideshow-state-bar">
                                <button class="on"></button>
                                <button></button>
                        </div>
                        <div class="slideshow-wrapper">
                                <?php for($i=0;$i<4;$i++): ?>
                                <article class="slideshow-item">
                                        <figure>
                                                <img src="http://placehold.it/1280x800" alt="City, Country" data-size="1280x800"/>
                                        </figure>
                                        <div class="info-wrapper">
                                                <a href="" rel="">
                                                        <h1>city, country</h1>
                                                        <span class="cursive">see hotels</span>
                                                        <span class="rounded-btn">go to spain</span>
                                                </a>
                                        </div>
                                </article>
                                <?php endfor; ?>
                        </div>
                </div>
        </header>
                
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