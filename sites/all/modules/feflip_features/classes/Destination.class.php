<?php

require_once('Helpers.class.php');
require_once('Hotel.class.php');

class Destination {

  /*
   * Return all nodes of destinations
   * @return array nodes
   */
  private static function getAllDestinationNodes($filter_field = '') {
    $query = new EntityFieldQuery;

    $query = $query->entityCondition('entity_type', 'node')
      ->entityCondition('bundle', 'destination')
      ->propertyCondition('status', 1)
      ->propertyOrderBy('title', 'ASC');

    if (!empty($filter_field)) {
      $query = $query->propertyCondition($filter_field, 1);
    }

    $queryResult = $query->execute();
    $nodes = array();
    if (isset($queryResult['node'])) {
      $nodes = node_load_multiple(array_keys($queryResult['node']));
    }

    return $nodes;
  }

  private static function getDestinations($nodes) {
    $continents = self::GetContinents();
    $destinations = array();
    // Force style image if is homepage
    $style = 'large';
    if (drupal_is_front_page()) {
      $style = 'itinerary_route_icon';
    }
    foreach ($nodes as $node) {
      $wrapper = entity_metadata_wrapper('node', $node);
      $image = Helpers::GetMainImageFromFieldCollection($node->field_images, $wrapper->title->value() . ', ' . $wrapper->field_country->value(), 'http://placehold.it/300x300', $style); //"http://placehold.it/300x300";
      // Add destination address book info
      $ab_result = AdminForms::AddressBookByDestination($node->nid);
      $ab_cats = array_unique(array_column($ab_result, 'association'));
      $ax_categories = array();
      $categories = array();
      if (isset($node->field_addressbook_summary['und']) && (count($node->field_addressbook_summary['und']) > 0)) {
          foreach ($node->field_addressbook_summary['und'] as $ab_key => $ab_value) {
              $abook = entity_load('field_collection_item',array($ab_value['value']));
              $abook = $abook[$ab_value['value']];
              $book_name = '';
              $book_dsc = '';
              $term = taxonomy_term_load($abook->field_association_to_interests['und'][0]['tid']);
              if (isset($term)) $book_name = $term->name;
              if (in_array($book_name, $ab_cats)) {
                  $book_dsc = $abook->field_addressbook_description['und'][0]['value'];
                  $ax_categories[strtolower($book_name)] = $book_dsc;
              }
          }
      }
      foreach ($ab_cats as $ab_cat){
          $categories[] = array('name' => strtolower($ab_cat), 'dsc' => (isset($ax_categories[strtolower($ab_cat)]) ? $ax_categories[strtolower($ab_cat)] : ''));
      }
      $destinations[] = array(
        'id' => $node->nid,
        'destination' => $wrapper->title->value(),
        'withcountry' => $wrapper->title->value() . ', ' . $wrapper->field_country->value(),
        'continent' => isset($continents[$wrapper->field_continent->value()]) ? $continents[$wrapper->field_continent->value()] : $wrapper->field_continent->value(),
        'url' => url('node/' . $node->nid),
        'image' => $image,
        'numhotels' => Hotel::NumHotelsByDestination($node->nid),
        'latitude' => $wrapper->field_latitude->value(),
        'longitude' => $wrapper->field_longitude->value(),
        'description' => isset($wrapper->field_description->value()['safe_value']) ? $wrapper->field_description->value()['safe_value'] : '',
        'maptourl' => drupal_get_path_alias('node/' . $node->nid . '/hotel-reviews'),
        'weatherid' => $wrapper->field_weather_id->value(),
        'summaries' => $categories
      );
    }

    return $destinations;
  }

  /*
   * Return all destinations
   * @return array
   */
  public static function GetAllDestination() {
    $cacheResult = Helpers::getCacheIfNotExpired('Destination_class_php::GetAllDestination', 'cache_blocks_page');
    if (!$cacheResult) {
      $nodes = self::getAllDestinationNodes('');
      $result = self::getDestinations($nodes);
      cache_set('Destination_class_php::GetAllDestination', $result, 'cache_blocks_page', REQUEST_TIME + (3600 * 24)); //1 day cache
    }
    else {
      $result = $cacheResult->data;
    }
    return $result;
  }

  public static function GetFooterDestinations() {
    $nodes = self::getAllDestinationNodes('promote');
    $destinations = array();
    foreach ($nodes as $node) {
      $wrapper = entity_metadata_wrapper('node', $node);
      $destinations[] = array(
        'id' => $node->nid,
        'destination' => $wrapper->title->value(),
        'withcountry' => $wrapper->title->value() . ', ' . $wrapper->field_country->value(),
        'url' => url('node/' . $node->nid),
      );
    }
    return $destinations;

  }

  public static function GetImagesForHomeSlideShow($subtitle) {
    $cacheId = 'Destination_class_php::GetImagesForHomeSlideShow_' . $subtitle;
    $cacheResult = Helpers::getCacheIfNotExpired($cacheId, 'cache_blocks_page');
    if (!$cacheResult) {
      $nodes = self::getAllDestinationNodes('promote_to_slideshow');
      $result = array();
      foreach ($nodes as $node) {
        $wrapper = entity_metadata_wrapper('node', $node);
        $image = Helpers::GetMainImageFromFieldCollection($node->field_images, $wrapper->title->value() . ', ' . $wrapper->field_country->value(), 'http://placehold.it/1280x800', 'headerslideshow');
        $image['linkto'] = url('node/' . $node->nid) . '/hotel-reviews';
        $image['destination'] = $wrapper->title->value();
        $image['subtitle'] = $subtitle;
        $image['btntext'] = 'go to ' . $wrapper->title->value();
        $result[] = $image;
      }
      cache_set($cacheId, $result, 'cache_blocks_page', REQUEST_TIME + 3600); //1 hour cache
    }
    else {
      $result = $cacheResult->data;
    }
    return $result;
  }

  public static function  GetAllImagesDestination($destination, $subtitle) {
    $wrapper = entity_metadata_wrapper('node', $destination);
    $images = Helpers::GetAllImagesFromFieldCollection($destination->field_images, $wrapper->title->value() . ', ' . $wrapper->field_country->value(), 'http://placehold.it/1280x800', 'headerslideshow');
    for ($i = 0; $i < count($images); $i++) {
      $images[$i]['subtitle'] = $subtitle;
    }
    return $images;
  }

  /**
   * Read continents from drupal field
   * @return mixed
   */
  public static function GetContinents() {
    $field = field_info_field('field_continent');
    $allowed_values = list_allowed_values($field);
    return $allowed_values;
  }

  /**
   *
   *   Check if destination has an itinerary related
   * @param id_destination
   * @return boolean
   */
  public static function HasItinerary($id_destination) {
    $efq = new EntityFieldQuery();
    $result = $efq->entityCondition('entity_type', 'node')
      ->entityCondition('bundle', 'itinerary')
      ->propertyCondition('status', 1)
      ->fieldCondition('field_destination', 'target_id', $id_destination, '=')
      ->count()
      ->execute();
    return $result > 0;
  }
}