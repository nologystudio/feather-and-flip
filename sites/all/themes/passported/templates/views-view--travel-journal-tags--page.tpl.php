<?php
    if (strpos($_SERVER['REQUEST_URI'], '/city-guide') === false) {
        drupal_goto('<front>');
        exit();
    }
    else { ?>
        <section id="travel-journal" ng-controller="BlogController" class="related">
            <header>
                <h4 data-animate="1">TRAVEL<span> journal </span></h4>
            </header>
            <div id="feed" class="align-center">
                <div class="grid-wrapper">
                    <?php $z = 2; ?>
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
                                <a class="quick-entry review" target="_blank" href="<?php echo $post->field_field_original_url[0]['raw']['safe_value']; ?>" data-animate="<?php echo $z; ?>">
                                    <h3><?php echo $title_slices[1]; ?></h3>
                                    <hr>
                                    <h4><?php echo $title_slices[0]; ?></h4>
                                    <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                </a>
                                <?php break;

                            default: ?>
                                <a class="quick-entry" data-size="<?php echo $img_wh[0].'x'.$img_wh[1]; ?>" target="_blank" href="<?php echo $post->field_field_original_url[0]['raw']['safe_value']; ?>" data-animate="<?php echo $z; ?>">
                                    <figure>
                                        <img src="<?php echo $img_url; ?>" alt=""/>
                                    </figure>
                                    <footer>
                                        <h4><?php echo $post->node_title; ?></h4>
                                        <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                    </footer>
                                </a>
                                <?php break;
                        }
                        $z++; ?>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>