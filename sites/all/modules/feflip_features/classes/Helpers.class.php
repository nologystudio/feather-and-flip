<?php

class Helpers
{

    // Fixed configuration values
    const RSS_URL = 'http://www.featherandflip.com/travel-journal/?format=rss';

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
                        $sizeImage = getimagesize($url);
                        $images[] = array( 'url'      => image_style_url($style,$image['uri']),
                                           'text'     => $imageText,
                                           'size'  => $sizeImage);
                    }
                }
            }
        }
    
        if (count($images) == 0) $images[] = array('url'      => $alternativeImage,
                                                   'text'     => $imageText,
                                                   'size'  => getimagesize($alternativeImage));
        
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
                    $sizeImage = getimagesize($url);
                    $image = array( 'url'      => image_style_url($style,$imageItems->field_mainimage['und'][0]['uri']),
                                    'text'     => $imageText,
                                    'size'  => $sizeImage);
                }
            }
        }
    
        if (!isset($image)) $image = array('url'      => $alternativeImage,
                                           'text'     => $imageText,   
                                           'size'  => getimagesize($alternativeImage));
        
        return $image;
    }

    // Import external rss
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
            $media = $item->children($namespaces['media']);
            $img = $media->content->attributes()->url;

            $rs[] = array(
                'title'     => (string)$item->title,
                'category'  => (string)$item->category,
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

                // Term reference
                $tid = self::feflipNewTerm('blog_categories', $rss_post['category']);
                if (!empty($tid)){
                    $post->field_blog_category->set(array(intval($tid)));
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
    public static function ChangeTextFieldMaxLength($field_name, $new_length) {
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

}