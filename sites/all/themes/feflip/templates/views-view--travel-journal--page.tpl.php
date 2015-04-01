<?php if (!drupal_is_front_page()) include 'slideshowandmainmenu.html.php'; ?>
<section id="travel-journal" ng-controller="BlogCtrl">
        <header>
                <h3 class="icon feather">TRAVEL<span> journal </span></h3>
        </header>
        <div class="feed-wrapper">
                <div id="newsletter-signup" class="quick-entry" ng-controller="NewsletterCtrl">
                    <h3>Join the adventure</h3>
                    <hr>
                    <h4 ng-if="currentStatus == 'still'">Sign up for our newsletter</h4>
                    <form name="newsletterForm">
                        <small id="error"   class="animated fadeInUp" ng-if="currentStatus == 'error'">We're sorry,<br>an error has occurred</small>
                        <small id="success" class="animated fadeInUp" ng-if="currentStatus == 'success'">Thanks!</small>
                        <input name="user-email" type="email" ng-if="currentStatus == 'still'" placeholder="Your email address" ng-model="signUpData.userEmail" required/>
                        <input type="submit" ng-if="currentStatus == 'still'" value="submit" ng-class="{disabled:!newsletterForm.$valid}" ng-click="!newsletterForm.$valid || regSubmit()"/>
                    </form>
                </div>
                <?php foreach ($view->result as $post) {
                        $title_slices = explode(':', $post->node_title);
                        if ((count($title_slices) > 1) && (isset($post->field_field_blog_category[0])) && ($post->field_field_blog_category[0]['rendered']['#title'] == 'Hotel Reviews'))
                                $type = 'review';
                        else
                                $type = 'entry';
                        $orig_date = strtotime($post->field_field_original_pubdate[0]['raw']['safe_value']);
                        $img_url = '';
                        if(isset($post->field_field_image[0]['raw']['uri']))
                            $img_url = image_style_url('post_image', $post->field_field_image[0]['raw']['uri']);
                        $img_wh = (empty($img_url) ? array('', '') : getimagesize($img_url));
                        
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
                <article id="instagram-feed" class="quick-entry review" ng-controller="InstagramCtrl" ng-show="lastImage">
                        <h3></h3>
                        <hr>
						<figure>
						<img src="{{lastImage}}"/>
					</figure>
                </article>
        </div>
        <footer>
                <a href="" class="section-button"></a>
        </footer>
</section>