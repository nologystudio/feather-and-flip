<?php if (!drupal_is_front_page() && (strpos($_SERVER['REQUEST_URI'], '/itinerary') === false) && (strpos($_SERVER['REQUEST_URI'], '/hotel-reviews') === false)) include 'slideshowandmainmenu.html.php'; ?>
<section id="travel-journal" ng-controller="BlogCtrl"<?php echo ((strpos($_SERVER['REQUEST_URI'], '/itinerary') !== false || (strpos($_SERVER['REQUEST_URI'], '/hotel-reviews') !== false)) ? ' class="related"' : ''); ?>>
        <header>
                <h3 class="icon feather">TRAVEL<span> journal </span></h3>
        </header>
        <div class="feed-wrapper">
                <?php if (strpos($_SERVER['REQUEST_URI'], '/itinerary') === false && strpos($_SERVER['REQUEST_URI'], '/hotel-reviews') === false && strpos($_SERVER['REQUEST_URI'], '/city-guide') === false) { ?>
                    <div id="newsletter-signup" class="quick-entry" ng-controller="NewsletterCtrl" ng-switch="currentStatus">
                        <h3>Join the adventure</h3>
                        <hr>
                        <h4 ng-switch-when="still">Sign up for our newsletter</h4>
                        <form>
                            <small id="error" class="animated fadeInUp" ng-switch-when="error">We're sorry,<br>an error has occurred</small>
                            <small id="success" class="animated fadeInUp" ng-switch-when="success">Thanks!</small>
                            <input name="user-email" type="email" ng-switch-when="still" placeholder="Your email address" value="{{signUpData.userEmail}}" ng-changed="checkChangedInput()" ng-model="signUpData.userEmail" required/>
                            <input type="submit" ng-switch-when="still" value="submit" ng-click="regSubmit()"/>
                        </form>
                    </div>
                <?php } ?>
                <?php foreach ($view->result as $post) {
                        $title_slices = explode(':', $post->node_title);
                        if ((count($title_slices) > 1) && ($post->field_field_blog_category[0]['rendered']['#title'] == 'Hotel Reviews'))
                                $type = 'review';
                        else
                                $type = 'entry';
                        $orig_date = strtotime($post->field_field_original_pubdate[0]['raw']['safe_value']);
                        $img_url = '';
                        if(isset($post->field_field_image[0]['raw']['uri']))
                            $img_url = image_style_url('post_image', $post->field_field_image[0]['raw']['uri']);
                        $img_wh = (empty($img_url) ? array('', '') : Helpers::safeGetImageSize($img_url));
                        
                        switch ($type) {
                                case 'review': ?>
                                        <a class="quick-entry review" target="_blank" href="<?php echo $post->field_field_original_url[0]['raw']['safe_value']; ?>">
                                                <h3><?php echo $title_slices[1]; ?></h3>
                                                <hr>
                                                <h4><?php echo $title_slices[0]; ?></h4>
                                                <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                        </a>
                                <?php break;
                                 
                                default: ?>
                                        <a class="quick-entry" data-size="<?php echo $img_wh[0].'x'.$img_wh[1]; ?>" target="_blank" href="<?php echo $post->field_field_original_url[0]['raw']['safe_value']; ?>">
                                                <figure>
                                                        <img src="<?php echo $img_url; ?>" alt=""/>
                                                </figure>
                                                <footer>
                                                        <h4><?php echo $post->node_title; ?></h4>
                                                        <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                                </footer>
                                        </a>
                                <?php break;
                         } ?>                        
                <?php } ?>
        </div>
        <footer>
                <a href="" class="section-button"></a>
        </footer>
</section>