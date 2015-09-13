<section id="travel-journal" ng-controller="BlogController">
    <header>
        <h4 data-animate="1">Travel <span>journal</span></h4>
    </header>
    <div id="feed" class="align-center">
        <?php if (isset($view->result) && !empty($view->result)): ?>
            <?php
            $featured = array_shift($view->result);
            $orig_date = strtotime($featured->field_field_original_pubdate[0]['raw']['safe_value']);
            $img_url = '';
            if(isset($featured->field_field_image[0]['raw']['uri']))
                $img_url = image_style_url('post_image_large', $featured->field_field_image[0]['raw']['uri']);
            $img_wh = (empty($img_url) ? array('', '') : getimagesize($img_url));
            ?>
            <a class="quick-entry featured" href="<?php echo $featured->field_field_original_url[0]['raw']['safe_value']; ?>" target="_blank" data-animate="2">
                <div class="mask">
                    <figure>
                        <img src="<?php echo $img_url; ?>" alt="<?php echo $featured->node_title; ?>"/>
                    </figure>
                    <footer>
                        <h4><?php echo $featured->node_title; ?></h4>
                        <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                    </footer>
                </div>
            </a>
            <div class="grid-wrapper">
                <?php
                    $i = 3;
                    foreach ($view->result as $post) {
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

                        if (!$img_wh){
                            $img_wh = array('500', '300');
                        }
                        switch ($type) {
                            case 'review': ?>
                                <a data-animate="<?php echo $i; ?>" class="quick-entry review" target="_blank" href="<?php echo $post->field_field_original_url[0]['raw']['safe_value']; ?>">
                                    <h3><?php echo $title_slices[1]; ?></h3>
                                    <hr>
                                    <h4><?php echo $title_slices[0]; ?></h4>
                                    <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                </a>
                            <?php break;
                             
                            default: ?>
                                <a data-animate="<?php echo $i; ?>" class="quick-entry" data-size="<?php echo $img_wh[0].'x'.$img_wh[1]; ?>" target="_blank" href="<?php echo $post->field_field_original_url[0]['raw']['safe_value']; ?>">
                                    <figure>
                                            <img style="width:<?php echo $img_wh[0].'px'; ?>;height:<?php echo $img_wh[1].'px'; ?>" src="<?php echo $img_url; ?>" alt=""/>
                                    </figure>
                                    <footer>
                                            <h4><?php echo $post->node_title; ?></h4>
                                            <time datetime="<?php echo date('Y-m-d i:s', $orig_date); ?>"><?php echo date('F, Y', $orig_date); ?></time>
                                    </footer>
                                </a>
                            <?php break;
                        }
                        $i++; ?>                        
                <?php } ?>
            </div>
        <?php endif; ?>
    </div>
    <footer>
        <button ng-click="viewAll()">
            <span>view all</span>
            <svg>
                <path d="M 0,0 L 100,0 L 50,50 L 0,0"/>
            </svg>
        </button>
    </footer>
</section>