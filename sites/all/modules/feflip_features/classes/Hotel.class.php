<?php

class Hotel
{
    /**
     *Returns nodes from result view
     *@param $view
     *@return array
     */
    private static function getNodes($view)
    {
          $nodes = array();
          
          foreach($view->result as $obj)
                $nodes[] = node_load($obj->nid);
        
          return $nodes;
    }

    private static function getHotelsInfo($nodes)
    {
        $hotelsinfo = array();
        
        foreach($nodes as $node)
        {
            $wrapper = entity_metadata_wrapper('node', $node);
            
            $imageurl = 'http://placehold.it/347x300';
            foreach($wrapper->field_images->value() as $image)
            {
                if (count($image->field_mainimage) > 0 && $image->field_main_image['und'][0]['value'] == '1')
                    $imageurl = image_style_url('hotel_review_347',$image->field_mainimage['und'][0]['uri']);
            }
            $categories = array();           
            foreach ($wrapper->field_hotel_tags->value() as $key => $tag) {
              $categories[] = strtolower($tag->name);
            }
            $hotelsinfo[] = array('name'        => $wrapper->title->value(),
                                  'destination' => $wrapper->field_destination->title->value().', '.$wrapper->field_destination->field_country->value(),
                                  'country'     => $wrapper->field_destination->field_country->value(),
                                  'image'       => $imageurl,
                                  'url'         => url('node/'.$node->nid),
                                  'sabreCode'   => $wrapper->field_hotelcode->value(),
                                  'expediaCode' => $wrapper->field_ean_hotelcode->value(),
                                  'categories'  => $categories
                                  );
        }
        
        return $hotelsinfo;        
    }
    
    /**
     *Return info to show in hotelreviews page
     *@return array Hotels info hotel name, distination and image
     */
    public static function HotelReviews($variables)
    {
        $view = $variables['view'];
        $nodes = self::getNodes($view);
        $hotelsinfo = self::getHotelsInfo($nodes);        
        return $hotelsinfo;
    }
    
    
    /**
     *Return all url of hotels by destination
     *@param $destinationId
     *@return array with nid and url fo all hotels by destination
     */
    public static function HotelUrl($destinationId)
    {
        $query = new EntityFieldQuery;
        
        $nodes = $query->entityCondition('entity_type', 'node')
          ->entityCondition('bundle', 'hotel')
          ->propertyCondition('status', 1)
          ->fieldCondition('field_destination','target_id', $destinationId, '=')
          ->execute();
          
        $links = array();
        
        if (isset($nodes['node']))
        {
            foreach($nodes['node'] as $node)
                $links[] = array('nid' => $node->nid, 'url' => url('node/'.$node->nid));
        }
        
        return $links;
    }
    
    /**
     *Return array with next and previous url of hotel
     *@param $node Hotel node
     *@return array
     */
    public static function NextPreviousUrlHotel($node)
    {
        $urls = self::HotelUrl($node->field_destination['und'][0]['entity']->nid);
        
        $numUrls = count($urls);
        $next = url('node/'.$node->nid);
        $previous = url('node/'.$node->nid);
  
        if ( $numUrls > 0)
        {
            $posActual = -1;
            
            for($i=0; $i<$numUrls; $i++)
            {
                $url = $urls[$i];
                if ($url['nid'] == $node->nid)
                {
                    $posActual = $i;
                    break;
                }
            }
            
            if ($posActual >= 0)
            {
                //First position
                if ($posActual == 0)
                {
                  $next = $urls[$posActual+1]['url'];
                  $previous = $urls[$numUrls-1]['url'];
                }
                //Last position
                else if ($posActual == $numUrls-1)
                {
                  $next = $urls[0]['url'];
                  $previous = $urls[$posActual-1]['url'];
                }
                else
                {
                  $next = $urls[$posActual+1]['url'];
                  $previous = $urls[$posActual-1]['url'];
                }
            }
        }
        
        return array('next' => $next, 'previous' =>$previous);
    }
    
    public static function GetContentBlocks($node)
    {
        $contentblocks = array();
        
        if (isset($node->field_contentblocks['und']) && count($node->field_contentblocks['und']) > 0)
        {
            $i=0;
            foreach($node->field_contentblocks['und'] as $item)
            {
                $contentblock = entity_load('field_collection_item',array($item['value']));
                $contentblock = array_shift($contentblock);
                $features = array();
                
                if (isset($contentblock->field_feature['und']) && count($contentblock->field_feature['und']) > 0)
                {
                    foreach($contentblock->field_feature['und'] as $feature)
                        $features[] = $feature['value'];
                }
                
                if(count($contentblocks) >0 && count($contentblocks[$i]) == 2) $i +=1;
                
                $contentblocks[$i][] = array('title'    => $contentblock->field_caption['und'][0]['value'],
                                             'features' => $features);
            }
        }
        
        return $contentblocks;
    }
    
    public static function GetImages($node)
    {
        $images = array();
        
        if (isset($node->field_images['und']) && count($node->field_images['und']) > 0)
        {
            
            foreach($node->field_images['und'] as $item)
            {
                $contentblock = entity_load('field_collection_item',array($item['value']));
                $contentblock = array_shift($contentblock);

                if (isset($contentblock->field_mainimage['und']) && count($contentblock->field_mainimage['und']) > 0)
                {
                    foreach($contentblock->field_mainimage['und'] as $image)
                    {
                        $url = image_style_url('hotel_1040',$image['uri']);
                        $imageSize = getimagesize($url);
                        $images[] = array( 'url'      => $url,
                                           'alt'  => $node->field_destination['und'][0]['entity']->title .', '.$node->field_destination['und'][0]['entity']->field_country['und'][0]['value'],
                                           'size'   => $imageSize);
                    }
                }
                
            }
        }

        if (count($images) == 0) $images[] = array('url' => "http://placehold.it/1040x650", 'alt' => 'City, Country', 'size' => getimagesize("http://placehold.it/1040x650"));
        
        return $images;
    }
    
    /**
     *Return number hotel by destination
     *@param destination id
     *@return integer
     */
    public static function NumHotelsByDestination($destinationID)
    {          
        $query = new EntityFieldQuery;
        
        $count = $query->entityCondition('entity_type', 'node')
          ->entityCondition('bundle', 'hotel')
          ->propertyCondition('status', 1)
          ->fieldCondition('field_destination','target_id', $destinationID, '=')
          ->count()
          ->execute();
          
        return $count;  
    }

    public static function GetFooterHotels()
    {
        $query = new EntityFieldQuery;
        
        $nodes = $query->entityCondition('entity_type', 'node')
          ->entityCondition('bundle', 'hotel')
          ->propertyCondition('status', 1)
          ->propertyCondition('promote', 1)
          ->execute();
        
        $hotels = array();

        if (isset($nodes['node']))
        {
            $nodes = node_load_multiple(array_keys($nodes['node']));
            $hotels = self::getHotelsInfo($nodes);
        }
        
        return $hotels;      
    }

    /**
     * Returns hotels code of sabre and expedia by destination
     * @param $destinationID
     * @return array
     */
    public static function GetHotelCodesByDestination($destinationID)
    {
        $query = new EntityFieldQuery;

        $nodes = $query->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'hotel')
            ->propertyCondition('status', 1)
            ->fieldCondition('field_destination','target_id', $destinationID, '=')
            ->execute();

        $codes = array();

        if (isset($nodes['node']))
        {
            $hotelsNode = node_load_multiple(array_keys($nodes['node']));
            foreach($hotelsNode as $hotel)
            {
                $wrapper = entity_metadata_wrapper('node', $hotel);
                $codes['sabre'][] = $wrapper->field_hotelcode->value();
                $codes['expedia'][] = $wrapper->field_ean_hotelcode->value();
            }
        }

        return $codes;
    }

    // Get the low rates from a server response between sabre & expedia ids
    public static function GetResponseRates($ratesData, $sabreId, $expediaId)
    {
      $exRate = $saRate = array('rate' => 0.0, 'currency' => '');
      if (isset($ratesData['expedia']) && isset($ratesData['expedia']['HotelListResponse']))
        $exRate = Expedia::GetLowRateFromResponse($ratesData['expedia']['HotelListResponse'], $expediaId);
      if (isset($ratesData['sabre']) && isset($ratesData['sabre']->AvailabilityOptions) && isset($ratesData['sabre']->AvailabilityOptions->AvailabilityOption))
        $saRate = Sabre::GetLowRateFromResponse($ratesData['sabre']->AvailabilityOptions->AvailabilityOption, $sabreId);
      return array('sabre' => $saRate, 'expedia' => $exRate);
    }

}
