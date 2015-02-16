<?php

require_once('Helpers.class.php');
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
        $continents = self::GetContinents();
        $destinations = array();
         // Force style image if is homepage
         $style = 'large';
         if (drupal_is_front_page())
            $style = 'itinerary_route_icon';
         foreach($nodes as $node)
         {
              $wrapper = entity_metadata_wrapper('node', $node);
              $image = Helpers::GetMainImageFromFieldCollection($node->field_images, $wrapper->title->value().', '.$wrapper->field_country->value(),'http://placehold.it/300x300', $style);//"http://placehold.it/300x300";
              $destinations[] =  array( 'id'            => $node->nid,
                                        'destination'   => $wrapper->title->value(),
                                        'withcountry'   => $wrapper->title->value().', '.$wrapper->field_country->value(),
                                        'continent'     => isset($continents[$wrapper->field_continent->value()]) ? $continents[$wrapper->field_continent->value()] : $wrapper->field_continent->value(),
                                        'url'           => url('node/'.$node->nid),
                                        'image'         => $image,
                                        'numhotels'     => Hotel::NumHotelsByDestination($node->nid),
                                        'latitude'      => $wrapper->field_latitude->value(),
                                        'longitude'     => $wrapper->field_longitude->value(),
                                        'description'   => isset($wrapper->field_description->value()['safe_value'])  ? $wrapper->field_description->value()['safe_value'] : '',
                                        'maptourl'      => drupal_get_path_alias('node/'.$node->nid . '/hotel-reviews'),
                                        'weatherid'     => $wrapper->field_weather_id->value()
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
    
    public static function GetImagesForHomeSlideShow($subtitle)
    {
         $nodes = self::getAllDestinationNodes('promote_to_slideshow');
         
         $images = array();
         
         foreach($nodes as $node)
         {
             $wrapper = entity_metadata_wrapper('node', $node);
             $image = Helpers::GetMainImageFromFieldCollection($node->field_images, $wrapper->title->value().', '.$wrapper->field_country->value(),'http://placehold.it/1280x800', 'headerslideshow');
             $image['linkto'] = url('node/'.$node->nid) . '/hotel-reviews';
             $image['destination'] = $wrapper->title->value();
             $image['subtitle'] = $subtitle;
             $image['btntext'] = 'go to ' . $wrapper->title->value();
             $images[] = $image;
         }
             
         return $images; 
    }

    public static function  GetAllImagesDestination($destination, $subtitle)
    {
        $wrapper = entity_metadata_wrapper('node', $destination);
        $images = Helpers::GetAllImagesFromFieldCollection($destination->field_images, $wrapper->title->value().', '.$wrapper->field_country->value(), 'http://placehold.it/1280x800', 'headerslideshow');
        for($i=0; $i < count($images); $i++)
            $images[$i]['subtitle'] = $subtitle;
        return $images;
    }

    /**
     * Read continents from drupal field
     * @return mixed
     */
    public static function GetContinents()
    {
        $field = field_info_field('field_continent');
        $allowed_values = list_allowed_values($field);
        return $allowed_values;
    }

    /**
     *
     *   Check if destination has an itinerary related
     *   @param id_destination
     *   @return boolean
     */
    public static function HasItinerary($id_destination)
    {
        $efq = new EntityFieldQuery();
        $result = $efq->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'itinerary')
            ->propertyCondition('status', 1)
            ->fieldCondition('field_destination','target_id', $id_destination, '=')
            ->count()
            ->execute();
        return $result > 0;
    }
}