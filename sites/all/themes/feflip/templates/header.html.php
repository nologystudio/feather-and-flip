      <?php 
        
        /* ------------------------------------------------------------------------------------------------------------- */
        /* | i | Header starts here... */ 
        /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ ?>
        
        <header>
                <a id="brand" href=""><img src="<?php echo variable_get('relativePath'); ?>media/brand/feather-and-flip-white-logo.png" alt="Feather+flip"/></a>
                <nav id="social-media" class="white">
                        <a href="" rel="twitter"></a>
                        <a href="" rel="facebook"></a>
                        <a href="" rel="instagram"></a>
                        <a href="" rel="pinterest"></a>
                        <a href="" rel="google-plus"></a>
                </nav>
                <!-- | 2 | Header gallery -->
                <div class="slideshow-gallery">
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
                                                <img src="<?php echo variable_get('relativePath'); ?>media/destination/barcelona-by-feather-and-flip.jpg" alt="City, Country"/>
                                        </figure>
                                        <div class="info-wrapper">
                                                <h1>city,country</h1>
                                                <a href="">see hotels</a>
                                                <a href="" class="rounded-btn">go to spain</a>
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
        
        <nav role="main-navigation">
                <div class="wrapper">
                        <form id="search">
                                <input type="text" placeholder="Enter destination or hotel" value=""/>
                                <input type="submit" value=""/>
                        </form>
                        <ul>
                                <li>
                                        <a href="/#/hotel-reviews">hotel reviews</a>
                                        <ul>
                                                <li><a href="#">hotel</a></li>
                                                <li><a href="#">hotel</a></li>
                                                <li><a href="#">hotel</a></li>
                                                <li><a href="#">hotel</a></li>
                                        </ul>
                                </li>
                                <li>
                                        <a href="/#/intineraries">itineraries</a>
                                        <ul>
                                                <li><a href="#">itinerary</a></li>
                                                <li><a href="#">itinerary</a></li>
                                                <li><a href="#">itinerary</a></li>
                                                <li><a href="#">itinerary</a></li>
                                        </ul>
                                </li>
                                <li><a href="/#/travel-journal">travel journal</a></li>
                                <li>
                                        <a href="/#/join-now">join now/sign in</a>
                                        <form class="sign-in" alt="no-follow">
                                                <div id="already-a-member">
                                                        <label>Already a member?</label>
                                                        <input type="email" placeholder="Your email address" value=""/>
                                                        <input type="password" placeholder="Password" value=""/>
                                                        <a id="forgot-password" href="">forgot password?</a>
                                                        <input type="submit" value="sign in"/>
                                                </div>
                                                <div id="upgrade">
                                                        <h4>you deserve an upgrade</h4>
                                                        <h5>create a free membership to access insider-only hotel rates not available to the public.</h5>
                                                        <a href="" class="rounded-btn">free membership</a>
                                                </div>
                                        </form>
                                </li>
                        </ul>
                </div>
        </nav>