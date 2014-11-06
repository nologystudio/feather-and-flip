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
                  $routes[] = array('name'            => isset($route->field_route_name['und'][0]['value']) ? $route->field_route_name['und'][0]['value'] : '',
                                    'description'     => isset($route->field_description['und'][0]['value']) ? $route->field_description['und'][0]['value'] : '',
                                    'image'           => 'http://placehold.it/200x200'
                                   );
            }
            
            $itineraryinfo['name'] = $wrapper->title->value();
            $itineraryinfo['destination'] = $wrapper->field_destination->title->value().', '.$wrapper->field_destination->field_country->value();
            $itineraryinfo['description'] = $wrapper->field_description->value()['value'];
            $itineraryinfo['routes'] = $routes;            
        }
        
        return $itineraryinfo;
    }
    
}
