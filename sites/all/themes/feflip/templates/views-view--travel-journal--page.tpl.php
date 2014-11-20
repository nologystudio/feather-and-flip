<section id="travel-journal" ng-controller="BlogCtrl">
        <header>
                <h3 class="icon feather">TRAVEL<span> journal </span></h3>
        </header>
        <div class="feed-wrapper">
                <div id="newsletter-signup" class="quick-entry">
                        <h3>Join the adventure</h3>
                        <hr>
                        <h4>Sign up for our newsletter</h4>
                        <form id="signupNewsLetter" method="POST">
                                <input id="user-email" type="email" placeholder="Your email address" value=""/>                
                                <input type="submit" value="submit"/>
                        </form>  
                </div>
                <?php foreach ($view->result as $post) {
                        $title_slices = explode(':', $post->node_title);
                        if ((count($title_slices) > 1) && ($post->field_field_blog_category[0]['rendered']['#title'] == 'Hotel Reviews'))
                                $type = 'review';
                        else
                                $type = 'entry';
                        $orig_date = strtotime($post->field_field_original_pubdate[0]['raw']['safe_value']);
                        
                        switch ($type) {
                                case 'review': ?>
                                        <article class="quick-entry review">
                                                <h3><?php echo $title_slices[1]; ?></h3>
                                                <hr>
                                                <h4><?php echo $title_slices[0]; ?></h4>
                                                <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                        </article>
                                <?php break;
                                 
                                default: ?>
                                        <article class="quick-entry">
                                                <figure>
                                                        <img src="<?php echo $post->field_field_original_image[0]['raw']['safe_value']; ?>" alt=""/>
                                                </figure>
                                                <footer>
                                                        <h4><?php echo $post->node_title; ?></h4>
                                                        <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                                </footer>
                                        </article>
                                <?php break;
                         } ?>                        
                <?php } ?>
                <article id="twitter-feed" class="quick-entry review">
                        <h3></h3>
                        <hr>
                        <h4>It is a long established fact that a reader will be distracted</h4>
                        <time datetime="2008-02-14 20:00">Date</time>
                </article>
                <article id="instagram-feed" class="quick-entry review">
                        <h3></h3>
                        <hr>
                </article>
        </div>
        <footer>
                <a href="" class="section-button"></a>
        </footer>
</section>