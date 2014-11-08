<?php

require_once('Hotel.class.php');

class Destination
{
    /*
     * Return all nodes of destinations
     * @return array nodes
     */
    private static function getAllDestinationNodes($filter_field='')
    {
          $dest_view = views_get_view('start_your_journey');
          // add filter criteria
          $dest_view->set_display('page');
          if(!empty($filter_field))
                $dest_view->add_item($dest_view->current_display, 'filter', 'node', $filter_field, array('operator' => '=','value' => 1));
          $dest_view->preview();
          
          $nodes = array();
          
          foreach($dest_view->result as $obj)
                $nodes[] = node_load($obj->nid);
        
          return $nodes;
    }

    private static function getDestinations($nodes)
    {
         $destinations = array();
         foreach($nodes as $node)
         {
              $wrapper = entity_metadata_wrapper('node', $node);
              $image = "http://placehold.it/300x300";
              $destinations[] =  array( 'destination'   => $wrapper->title->value(),
                                        'withcountry'   => $wrapper->title->value().', '.$wrapper->field_country->value(),   
                                        'url'           => url('node/'.$node->nid),
                                        'image'         => $image,
                                        'numhotels'     => Hotel::NumHotelsByDestination($node->nid)
                                      );
         }
         
         return $destinations;         
    }

    /*
     * Return all destinations
     * @return array
     */
    public static function GetAllDestination()
    {
         $nodes = self::getAllDestinationNodes('');
         $destinations =  self::getDestinations($nodes);         
         return $destinations;        
    }

    public static function GetFooterDestinations()
    {
         $nodes = self::getAllDestinationNodes('promote');
         $destinations =  self::getDestinations($nodes);         
         return $destinations; 
    }
}