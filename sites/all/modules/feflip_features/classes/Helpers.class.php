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
                        $tamanio = getimagesize($url);
                        $images[] = array( 'url'      => image_style_url($style,$image['uri']),
                                           'text'     => $imageText,
                                           'tamanio'  => $tamanio);
                    }
                }
            }
        }
    
        if (count($images) == 0) $images[] = array('url'      => $alternativeImage,
                                                   'text'     => $imageText,
                                                   'tamanio'  => getimagesize($alternativeImage));
        
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
                    $tamanio = getimagesize($url);
                    $image = array( 'url'      => image_style_url($style,$imageItems->field_mainimage['und'][0]['uri']),
                                    'text'     => $imageText,
                                    'tamanio'  => $tamanio);
                }
            }
        }
    
        if (!isset($image)) $image = array('url'      => $alternativeImage,
                                           'text'     => $imageText,   
                                           'tamanio'  => getimagesize($alternativeImage));
        
        return $image;
    }

    // Import external rss
    public static function ImportExternalRss()
    {
        $rss = self::ParseExternalRss();
        // TODO: implement method for save new rss items to drupal database
        // private static function RssToNodes()
        // 
        // self::RssToNodes();
        return $rss;
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
            $rs[] = array(
                'title'     => (string)$item->title,
                'category'  => (string)$item->category,
                'pubDate'   => (string)$item->pubDate,
                'url'       => (string)$item->link,
                'description' => (string)$item->description,
                'img'       => ''
            );
        }
        return $rs;
    }

    // Create nodes in drupal from rss result
    // @param array $items ['title', 'category', 'pubDate', 'url', 'description', 'img']
    private static function RssToNodes($items)
    {
        // TODO:
    }

}