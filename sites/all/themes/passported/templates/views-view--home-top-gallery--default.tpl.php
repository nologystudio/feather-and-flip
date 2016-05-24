<div class="gallery-wrapper" ui-gallery>
    <?php if (isset($view->result) && !empty($view->result)): ?>
        <ul>
            <?php foreach ($view->result as $post) {
                $orig_date = strtotime($post->field_field_original_pubdate[0]['raw']['safe_value']);
                $post_url = $post->field_field_original_url[0]['raw']['safe_value'];
                $img_url = image_style_url('home_top_gallery', $post->field_field_image[0]['raw']['uri']); ?>
                <li>
                    <a href="<?php echo $post_url; ?>" target="_blank" class="blog-entry">
                        <figure>
                            <img src="<?php echo $img_url; ?>" alt="<?php echo $post->node_title; ?>"/>
                        </figure>
                        <footer>
                            <h2><?php echo $post->node_title; ?></h2>
                            <time><?php echo date('F, Y', $orig_date); ?></time>
                        </footer>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php endif; ?>
    <button rel="left">
        <svg width="40" height="80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <g id="left-arrow"><path d="M 0,0 L 0,0 L 40,40 L 0,80"></path></g>
            </defs>
            <use x="0" y="0" xlink:href="#left-arrow"/>
        </svg>
        <span></span>
    </button>
    <button rel="right">
        <svg width="40" height="80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <g id="right-arrow"><path d="M 40,0 L 40,0 L 0,40 L 40,80"></path></g>
            </defs>
            <use x="0" y="0" xlink:href="#right-arrow"/>
        </svg>
        <span></span>
    </button>
</div>