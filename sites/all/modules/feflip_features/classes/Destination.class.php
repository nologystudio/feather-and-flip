<?php

require_once('Hotel.class.php');

class Destination
{
    /*
     * Return all nodes of destinations
     * @return array nodes
     */
    private static function getAllDestinationNodes()
    {
          $dest_view = views_get_view('start_your_journey');
          // add filter criteria
          $dest_view->set_display('page');
          $dest_view->preview();
          
          $nodes = array();
          
          foreach($dest_view->result as $obj)
                $nodes[] = node_load($obj->nid);
        
          return $nodes;
    }
    
    /*
     * Return all destinatios in format "Destination, Country"
     * @return array string
     */
    public static function getAllDestinationTileCountry()
    {
         $nodes = self::getAllDestinationNodes();
        
         $destinations = array();
         foreach($nodes as $node)
         {
              $wrapper = entity_metadata_wrapper('node', $node);
              $destinations[] =  array( 'destination' => $wrapper->title->value().', '.$wrapper->field_country->value(),
                                        'url'         => url('node/'.$node->nid));
         }
         
         return $destinations;
    }
    
     /*
     * Return all destinatios in format "Destination, Country"
     * @return array string
     */
    public static function getAllDestinationTitleCountryAndNumHotels()
    {
         $nodes = self::getAllDestinationNodes();
        
         $destinations = array();
         foreach($nodes as $node)
         {
            $wrapper = entity_metadata_wrapper('node', $node);
            
            $destinations[] = array('destination' => $wrapper->title->value().', '.$wrapper->field_country->value() ,
                                    'numhotels'   => Hotel::NumHotelsByDestination($node->nid));
         }
         
         return $destinations;        
        
    }
}