<div class="gallery-wrapper" ui-gallery>
    <?php if (isset($view->result) && !empty($view->result)): ?>
        <ul>
            <?php $outpost = []; ?>
            <?php foreach ($view->result as $post) {
                $orig_date = strtotime($post->field_field_original_pubdate[0]['raw']['safe_value']);
                $post_url = $post->field_field_original_url[0]['raw']['safe_value'];
                $img_url = image_style_url('home_top_gallery', $post->field_field_image[0]['raw']['uri']);

                if ($post->node_title == 'Travel made transparent')
                    $pdate = 'Find out';
                else
                    $pdate = date('F, Y', $orig_date);

                $out = '<li><a href="'.$post_url.'" target="_blank" class="blog-entry">';
                $out .= '<figure><img src="'.$img_url.'" alt="'.$post->node_title.'"/></figure>';
                $out .= '<footer><h2>'.$post->node_title.'</h2><time>'.$pdate.'</time>';
                $out .= '</footer></a></li>';

                $outpost[$post->node_title] = $out;
            }
            $featured = null;
            if (isset($outpost['Travel made transparent'])):
                $featured = $outpost['Travel made transparent'];
                unset($outpost['Travel made transparent']);
            endif;
            $z = 0;
            foreach ($outpost as $op):
                if ($z == 1 && isset($featured))
                    print $featured;
                print $op;
                $z++;
            endforeach; ?>
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