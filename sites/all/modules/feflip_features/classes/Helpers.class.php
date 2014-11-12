<?php

class Helpers
{

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

}