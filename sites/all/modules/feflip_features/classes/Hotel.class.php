<?php

class Hotel
{
    /*
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
    
    /*
     *Return info to show in hotelreviews page
     *@return array Hotels info hotel name, distination and image
     */
    public static function HotelReviews($variables)
    {
        $view = $variables['view'];
        $nodes = self::getNodes($view);
        $hotelsinfo = array();
        
        foreach($nodes as $node)
        {
            $wrapper = entity_metadata_wrapper('node', $node);
            $hotelsinfo[] = array('name'        => $wrapper->title->value(),
                                  'destination' => $wrapper->field_destination->title->value().', '.$wrapper->field_destination->field_country->value(),
                                  'image'       => 'http://placehold.it/347x300'
                                  );    
        }
        
        return $hotelsinfo;
    }
    
    /*
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
}
