<!-- Blog -->
<section id="passported-picks">
    <div class="wrapper">
        <header>
            <h2>Passported Picks</h2>
        </header>
        <?php if (isset($view->result) && !empty($view->result)):
            $featured = array_shift($view->result);
            $orig_date = strtotime($featured->field_field_original_pubdate[0]['raw']['safe_value']);
            $img_url = '';
            if(isset($featured->field_field_image[0]['raw']['uri']))
            $img_url = image_style_url('tj_main_bottom', $featured->field_field_image[0]['raw']['uri']);
            ?>
            <article id="article-<?php echo $featured->nid; ?>" class="main">
                <time><?php echo date('F j, Y', $orig_date); ?></time>
                <h3><?php echo $featured->node_title; ?></h3>
                <figure>
                    <img src="<?php echo $img_url; ?>" alt="<?php echo $featured->node_title; ?>"/>
                </figure>
                <p><?php echo $featured->field_body[0]['raw']['value']; ?></p>
                <a href="<?php echo $featured->field_field_original_url[0]['raw']['safe_value']; ?>" target="_blank">Read More</a>
            </article>
            <?php foreach ($view->result as $post) {
                $img_url = '';
                if(isset($post->field_field_image[0]['raw']['uri']))
                    $img_url = image_style_url('post_bottom', $post->field_field_image[0]['raw']['uri']);
                $orig_date = strtotime($post->field_field_original_pubdate[0]['raw']['safe_value']); ?>
                <a id="article-<?php echo $post->nid; ?>" href="<?php echo $post->field_field_original_url[0]['raw']['safe_value']; ?>">
                    <figure>
                        <img src="<?php echo $img_url; ?>" alt="<?php echo $post->node_title; ?>"/>
                    </figure>
                    <time><?php echo date('F j, Y', $orig_date); ?></time>
                    <h3><?php echo $post->node_title; ?></h3>
                </a>
            <?php } ?>
        <?php endif; ?>
        <a id="book-a-trip" href="/book-hotels" class="call-to-action">
            <div class="vertical-wrapper">
                <div class="icon"></div>
                <h3>Need to book a trip</h3>
                <button class="rounded-btn white">Contact our hotel experts</button>
            </div>
        </a>
        <a id="explore" href="/city-guides" class="call-to-action">
            <div class="vertical-wrapper">
                <div class="icon"></div>
                <h3>Explore our city guides</h3>
                <button class="rounded-btn white">See more</button>
            </div>
        </a>
    </div>
</section>