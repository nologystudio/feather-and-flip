<?php

class Itinerary
{
    
    /*
     *Return info to show in itineraries page
     *@return array Itinineraries info
     */
    public static function ItinerariesInfo($view)
    {        
        $itineraryinfo['name'] = '';
        $itineraryinfo['destination'] = '';
        $itineraryinfo['description'] = '';
        $itineraryinfo['routes'] = array();
        
        if (count($view->result) > 0 )
        {
            $node = node_load($view->result[0]->nid);
            $wrapper = entity_metadata_wrapper('node', $node);
            

            
            $routes = array();
            foreach($wrapper->field_route->value() as $route)
            {
                 $imageurl = 'http://placehold.it/200x200';

                 if (count($route->field_image) > 0)
                          $imageurl = image_style_url('large',$route->field_image['und'][0]['uri']);
                  
                  $routes[] = array('name'            => isset($route->field_route_name['und'][0]['value']) ? $route->field_route_name['und'][0]['value'] : '',
                                    'description'     => isset($route->field_description['und'][0]['value']) ? $route->field_description['und'][0]['value'] : '',
                                    'image'           => $imageurl
                                   );
            }
            
            $images = array();
            foreach($wrapper->field_images->value() as $image)
            {
                if (count($image->field_mainimage) > 0)
                    $images[] = image_style_url('large',$image->field_mainimage['und'][0]['uri']);
            }
            
            if (count($images) == 0) $images[] = 'http://placehold.it/1040x650';
            
            $itineraryinfo['name'] = $wrapper->title->value();
            $itineraryinfo['destination'] = $wrapper->field_destination->title->value().', '.$wrapper->field_destination->field_country->value();
            $itineraryinfo['description'] = $wrapper->field_description->value()['value'];
            $itineraryinfo['images'] = $images; 
            $itineraryinfo['routes'] = $routes;            
        }
        
        return $itineraryinfo;
    }
    
}
