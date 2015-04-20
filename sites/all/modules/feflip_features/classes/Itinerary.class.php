<?php

class Itinerary
{
    
    /*
     *Return info to show in itineraries page
     *@return array Itinineraries info
     */
    public static function ItinerariesInfo($view)
    {
        $destinationId = $view->args[0];

        $query = new EntityFieldQuery;
        $nodes = $query->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'itinerary')
            ->propertyCondition('status', 1)
            ->fieldCondition('field_destination','target_id', $destinationId, '=')
            ->propertyOrderBy('title', 'ASC')
            ->execute();
        
        $node = null;
        if (isset($nodes['node'])) {
            $keys = array_keys($nodes['node']);
            $node = node_load($keys[0]);
        }

        $itineraryinfo['name'] = '';
        $itineraryinfo['destination'] = '';
        $itineraryinfo['description'] = '';
        $itineraryinfo['routes'] = array();
        
        if (isset($node))
        {
            $wrapper = entity_metadata_wrapper('node', $node);

            $routes = array();
            foreach($wrapper->field_route->value() as $route)
            {
                 $imageurl = 'http://placehold.it/200x200';

                 if (count($route->field_image) > 0)
                          $imageurl = image_style_url('itinerary_route_icon',$route->field_image['und'][0]['uri']);
                  
                  $routes[] = array('name'            => isset($route->field_route_name['und'][0]['value']) ? $route->field_route_name['und'][0]['value'] : '',
                                    'description'     => isset($route->field_description['und'][0]['value']) ? $route->field_description['und'][0]['value'] : '',
                                    'image'           => $imageurl
                                   );
            }
            
            $images = array();
            foreach($wrapper->field_images->value() as $image)
            {
                if (count($image->field_mainimage) > 0)
                {
                    $url = image_style_url('itinerary_1040',$image->field_mainimage['und'][0]['uri']);
                    $images[] = array('url'     => $url,
                                      'size' => getimagesize($url)
                                      );
                }
            }
            
            if (count($images) == 0) $images[] = array('url' =>'http://placehold.it/1040x650', 'size'=>getimagesize('http://placehold.it/1040x650'));
            
            $itineraryinfo['name'] = $wrapper->title->value();
            $itineraryinfo['destination'] = $wrapper->field_destination->title->value().', '.$wrapper->field_destination->field_country->value();
            $itineraryinfo['description'] = $wrapper->field_description->value()['value'];
            $itineraryinfo['images'] = $images; 
            $itineraryinfo['routes'] = $routes;            
        }
        
        return $itineraryinfo;
    }
    
}
