<?php

class Helpers
{

    // Fixed configuration values
    const RSS_URL = 'http://blog.featherandflip.com/?format=rss';

    public static function GetAllImagesFromFieldCollection($fieldCollection, $imageText, $alternativeImage, $style)
    {
        $images = array();

        if (isset($fieldCollection['und']) && count($fieldCollection['und']) > 0)
        {

            foreach($fieldCollection['und'] as $item)
            {
                $imageItems = entity_load('field_collection_item',array($item['value']));
                $imageItems = array_shift($imageItems);

                if (isset($imageItems->field_mainimage['und']) && count($imageItems->field_mainimage['und']) > 0)
                {
                    foreach($imageItems->field_mainimage['und'] as $image)
                    {
                        $url = image_style_url($style,$image['uri']);
                        $sizeImage = self::safeGetImageSize($url);
                        $images[] = array( 'url'      => image_style_url($style,$image['uri']),
                                           'text'     => $imageText,
                                           'size'  => $sizeImage,
                                            'marble' => image_style_url('itinerary_main_icon',$imageItems->field_mainimage['und'][0]['uri']));
                    }
                }
            }
        }

        if (count($images) == 0) $images[] = array('url'      => $alternativeImage,
                                                   'text'     => $imageText,
                                                   'size'  => self::safeGetImageSize($alternativeImage),
                                                    'marble' => 'http://placehold.it/100x100');

        return $images;
    }

    public static function GetMainImageFromFieldCollection($fieldCollection, $imageText, $alternativeImage, $style)
    {
        $image = NULL;

        if (isset($fieldCollection['und']) && count($fieldCollection['und']) > 0)
        {

            foreach($fieldCollection['und'] as $item)
            {
                $imageItems = entity_load('field_collection_item',array($item['value']));
                $imageItems = array_shift($imageItems);

                if (isset($imageItems->field_mainimage['und']) && count($imageItems->field_mainimage['und']) > 0 && $imageItems->field_main_image['und'][0]['value'] == 1)
                {
                    $url = image_style_url($style,$imageItems->field_mainimage['und'][0]['uri']);
                    $sizeImage = Helpers::safeGetImageSize($url);
                    $image = array( 'url'      => $url,
                                    'text'     => $imageText,
                                    'size'  => $sizeImage);
                }
            }
        }

        if (!isset($image)) $image = array('url'      => $alternativeImage,
                                           'text'     => $imageText,
                                           'size'  => self::safeGetImageSize($alternativeImage));

        return $image;
    }

  /**
   * Import external rss
   */
  public static function ImportExternalRss()
    {
        try {
            $rss = self::ParseExternalRss();
            self::RssToNodes($rss);
        } catch (Exception $e) {
            watchdog('error', 'Importing F+F rss: '.$e->getMessage());
        }
        watchdog('cron', 'Imported F+F rss');
    }

    // Read and parse external rss
    private static function ParseExternalRss()
    {
        $ch = curl_init();
        curl_setopt_array($ch,array(
            CURLOPT_URL             => self::RSS_URL,
            CURLOPT_USERAGENT       => 'crawler_rss',
            CURLOPT_TIMEOUT         => 120,
            CURLOPT_CONNECTTIMEOUT  => 30,
            CURLOPT_RETURNTRANSFER  => TRUE,
            CURLOPT_ENCODING        => 'UTF-8'
        ));
        $data = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $rs = array();
        foreach ($xml->channel->item as $item) {

            // Get media namespaces and get img url
            $namespaces = $item->getNameSpaces(true);
            if (isset($namespaces['media'])){
                $media = $item->children($namespaces['media']);
                $img = $media->content->attributes()->url;
            }
            else {
                $img = '';
            }

            $rs[] = array(
                'title'     => (string)$item->title,
                'categories'  => (array)$item->category,
                'pubDate'   => (string)$item->pubDate,
                'url'       => (string)$item->link,
                'description' => (string)$item->description,
                'img'       => preg_replace('/\/(\d+)w\//', '/1500w/', (string)$img)
            );
        }
        return $rs;
    }

    // Create nodes in drupal from rss result
    // @param array $items ['title', 'category', 'pubDate', 'url', 'description', 'img']
    private static function RssToNodes($items)
    {
        foreach ($items as $rss_post) {
            // Check if node exists by title
            $efq = new EntityFieldQuery();
            $result = $efq->entityCondition('entity_type', 'node')
                ->entityCondition('bundle', 'post')
                ->propertyCondition('title', $rss_post['title'], '=')
                ->execute();
            if (empty($result['node'])) {
                // Create node
                $post = self::feflipNewContent('post');
                $post->title->set($rss_post['title']);
                $post->created->set(strtotime($rss_post['pubDate']));
                $post->body->set(array('value' => $rss_post['description']));
                $post->field_original_pubdate->set($rss_post['pubDate']);
                $post->field_original_url->set($rss_post['url']);
                $post->field_original_image->set($rss_post['img']);
                /*if (!empty($rss_post['img'])) {
                    $fname = strtolower(str_replace(' ', '-', $rss_post['title']));
                    $idata = file_get_contents($rss_post['img']);
                    $simg = file_put_contents('public://'.$fname.'.jpg', $idata);
                    $img = file_get_contents('public://'.$fname.'.jpg');
                    $fpath = drupal_realpath('public://'.$fname.'.jpg');
                    watchdog('debug', $fpath);
                    $post->field_image->file->set($fpath);
                }*/
                if (!empty($rss_post['img'])) {

                    $fname = urlencode(strtolower(str_replace(' ', '-', $rss_post['title']))) . '.jpg';
                    $fpath = 'public://'.$fname;
                    $idata = file_get_contents($rss_post['img']);
                    file_put_contents($fpath, $idata);

                    $file = new stdClass;
                    $file->uid = '1';
                    $file->filename = $fname;
                    $file->uri = $fpath;
                    $file->filemime = mime_content_type($fpath);
                    $file->filesize = filesize($fpath);
                    $file->status = 1;
                    $file = file_save($file, FILE_EXISTS_REPLACE);

                    $post->field_image->file->set($file);
                }

                // Term reference
                $tids = array();
                foreach ($rss_post['categories'] as $cat) {
                    $tid = self::feflipNewTerm('blog_categories', $cat);
                    $tids[] = (intval($tid));
                }
                if (!empty($tids)){
                    $post->field_blog_category->set($tids);
                }
                $post->save();
            }
        }
    }

    // Set a new entity by type
    private static function feflipNewContent($type = 'page')
    {
        $values = array(
            'type' => $type,
            'uid' => 1,
            'status' => 1,
            'comment' => 0,
            'promote' => 0,
        );
        $entity = entity_create('node', $values);
        return entity_metadata_wrapper('node', $entity);
    }

    // Create or get term and return term id
    private static function feflipNewTerm($vocab = '', $term = '')
    {
        $tid = '';
        if (!empty($vocab) && !empty($term)){
            $arr_terms = taxonomy_get_term_by_name($term, $vocab);
            if (!empty($arr_terms)) {
                $arr_terms = array_values($arr_terms);
                $tid = $arr_terms[0]->tid;
            }
            else {
                $vobj = taxonomy_vocabulary_machine_name_load($vocab);
                $nterm = new stdClass();
                $nterm->name = $term;
                $nterm->vid = $vobj->vid;
                taxonomy_term_save($nterm);
                $tid = $nterm->tid;
            }
        }
        return $tid;

    }

    public static function GetSocialMediaMenu($class)
    {
            $menu = menu_tree_all_data('menu-social-media-links');

            $result = '<nav id="social-media" class="'.$class.'">';
            foreach ($menu as $key => $menu_item) {
                 $result .= '<a href="'.$menu_item['link']['link_path'].'" target="_blank" rel="'.strtolower($menu_item['link']['link_title']).'"></a>';
            }

            $result .= '</nav>';

            return $result;
    }

    /**
     * Return info of users booking
     * @return array
     */
    public static function  GetBookingInfoByUser()
    {
        global $user;

        $query = new EntityFieldQuery;

        $forms = $query->entityCondition('entity_type', 'entityform')
            ->entityCondition('type', 'booking')
            ->propertyCondition('uid', $user->uid)
            ->propertyCondition('draft', 0)
            ->execute();

        $submisions = array();

        if (isset($forms['entityform']))
        {
            $resultquery = $forms['entityform'];
            $keys = array_keys($resultquery);
            foreach ($keys as $key)
                $submisions[] = entity_load_single('entityform', $key);
        }

        return $submisions;
    }

    public static function GetFeatherFlipUser()
    {
        global $user;
        $loadUser = user_load($user->uid);
        return $loadUser;
    }

    /**
     * Change max length  of text field
     * @param $field_name
     * @param $new_length
     */
    public static function ChangeTextFieldMaxLength($field_name, $new_length)
    {
        $field_table = 'field_data_' . $field_name;
        $field_revision_table = 'field_revision_' . $field_name;
        $field_column = $field_name . '_value';

        // Alter value field length in fields table
        db_query("ALTER TABLE {$field_table} CHANGE {$field_column} {$field_column} VARCHAR( {$new_length} )");
        // Alter value field length in fields revision table
        db_query("ALTER TABLE {$field_revision_table} CHANGE {$field_column} {$field_column} VARCHAR( {$new_length} )");

        // Update field config with new max length
        $result = db_query("SELECT CAST(data AS CHAR(10000) CHARACTER SET utf8) FROM field_config WHERE field_name = '{$field_name}'");
        $config = $result->fetchField();
        $config_array = unserialize($config);
        $config_array['settings']['max_length'] = $new_length;
        $config = serialize($config_array);
        db_update('field_config')
            ->fields(array('data' => $config))
            ->condition('field_name', $field_name)
            ->execute();
    }

    /*
    *   Return boolean if string parameter exists in current url
    */
    public static function IsStickySection()
    {
        $header = drupal_get_http_header("status");

        if ((strpos($_SERVER['REQUEST_URI'], '/map-it') !== false) ||
            (strpos($_SERVER['REQUEST_URI'], '/booking-info') !== false) ||
            (strpos($_SERVER['REQUEST_URI'], '/booking-error') !== false) ||
            $header == "404 Not Found" ||
            $header == "403 Forbidden")
            return true;
        else
            return false;
    }


    public static function get_device_type()
    {

        if (self::request_is_mobile()) {
            $user_agent = strtolower(self::get_http_header('User-Agent'));

            if (preg_match("/(Android)/i", $user_agent)) {
                if (!preg_match("/(mobile)/i", $user_agent))
                    return 'tablet';
            }

            /* if (preg_match("/(iPhone|Android)/i", $user_agent)) { */
            if (preg_match("/ipad/i", $user_agent)) {
                /*  if (preg_match("/(ipad)/i", $user_agent)) {*/
                return 'ipad';
            }
            if (preg_match("/(iPhone)/i", $user_agent)) {
                /*  if (preg_match("/(ipad)/i", $user_agent)) {*/
                return 'ios';
            }
            return 'mobile';
        }
        return 'desktop';
    }


    public static function request_is_mobile()
    {
        if (self::get_http_header('X-Wap-Profile')!='' || self::get_http_header('Profile')!='') {
            return true;
        }
        if (stripos(self::get_http_header('Accept'), 'wap') !== false) {
            return true;
        }
        $user_agent = strtolower(self::get_http_header('User-Agent'));

        $ua_prefixes = array(
            'w3c ', 'w3c-', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq',
            'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco',
            'eric', 'hipt', 'htc_', 'inno', 'ipaq', 'ipod', 'jigs', 'kddi', 'keji',
            'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'lg/u', 'maui', 'maxo', 'midp',
            'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki',
            'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage',
            'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-',
            'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi',
            'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-', 'ipad'
        );
        if (in_array(substr($user_agent, 0, 4), $ua_prefixes)) {
            return true;
        }
        $ua_keywords = array(
            'android', 'blackberry', 'hiptop', 'ipod', 'lge vx', 'midp',
            'maemo', 'mmp', 'netfront', 'nintendo DS', 'novarra', 'openweb',
            'opera mobi', 'opera mini', 'palm', 'psp', 'phone', 'smartphone',
            'symbian', 'up.browser', 'up.link', 'wap', 'windows ce', 'ipad'
        );
        if (preg_match("/(" . implode("|", $ua_keywords) . ")/i", $user_agent)) {
            return true;
        }
        return false;
    }


    public static function get_http_header($name, $original_device=true, $default='')
    {
        if ($original_device) {
            $original = self::get_http_header("X-Device-$name", false);
            if ($original!=='') {
                return $original;
            }
        }
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }
        return $default;
    }

    // Get promoted parametrized content
    public static function get_promoted_content($type='')
    {
        if (!empty($type)) {
            $query = new EntityFieldQuery;

            $query = $query->entityCondition('entity_type', 'node')
                ->entityCondition('bundle', $type)
                ->propertyCondition('promote', 1)
                ->propertyCondition('status', 1);
            $queryResult = $query->execute();
            $nodes = array();
            if (isset($queryResult['node']))
                $nodes = node_load_multiple(array_keys($queryResult['node']));
            return $nodes;
        }
        else {
            return array();
        }
    }

  /**
   * @param $url
   * @return array
   */
  public static function safeGetImageSize($url) {
    return (file_exists($url))?getimagesize($url):array('', '');
  }

  /**
   * @param string $cacheId Name of the cache
   * @param string $cacheBin Name of the cache bin
   * @return bool FALSE if not cache found
   */
  public static function getCacheIfNotExpired($cacheId, $cacheBin = 'cache') {
    $result = FALSE;
    if (($cacheData = cache_get($cacheId, $cacheBin)) && REQUEST_TIME < $cacheData->expire) {
      $result = $cacheData;
    }
    return $result;
  }
}