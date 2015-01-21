<?php

/**
 * Add body classes if certain regions have content.
 */
function feflip_preprocess_html(&$variables) {
    /*
    $productionURL  = 'feather+flip.com';
    $uriSplitter    = explode('/',$_SERVER['REQUEST_URI']);
    $url            = ($_SERVER['HTTP_HOST'] == $productionURL) ? '' : $uriSplitter[1].'/sites/all/themes/feflip';
    */
    $relativePath   = '/sites/all/themes/feflip/';//$url.'/';

    variable_set('relativePath', $relativePath);
    // AboutUs->nid=27; FAQ->nid=28
    $static_nodes = array('html__node__27', 'html__node__28', 'html__node__86', 'html__node__87', 'html__node__88', 'html__node__89');
    $error_node = array ('html__node__288', 'html__node__332', 'html__node__333');
    $arg = arg();

    variable_set('pageID', 'global');
        
	if (drupal_is_front_page())
        variable_set('pageID', 'home');
    else if (isset($arg[2]) && $arg[2] == 'hotel-reviews')
        variable_set('pageID', 'hotel-reviews');
    else if (isset($arg[2]) && $arg[2] == 'itinerary')
        variable_set('pageID', 'itinerary');
    else if (isset($arg[0]) && $arg[0] == 'map-it')
       variable_set('pageID', 'map-it');
    else if (array_search('node-type-hotel', $variables['classes_array']) !== false)
        variable_set('pageID', 'hotel');
    else if (isset($arg[0]) && $arg[0] == 'travel-journal')
        variable_set('pageID', 'travel-journal');
    else if (isset($arg[0]) && $arg[0] == 'booking-info')
        variable_set('pageID', 'confirmation');
    else{

      foreach($variables['theme_hook_suggestions'] as $item)
      {
          if (array_search($item, $error_node) !== false)
          {
              variable_set('pageID', 'error');
              break;
          }

          if (array_search($item, $static_nodes) !== false)
          {
              variable_set('pageID', 'static');
              break;
          }
      }
    }
}


/**
 * Override or insert variables into the page template for HTML output.
 */
function feflip_process_html(&$variables) {

  //Load footer fixed menu
  $variables['footer_fixed_menu'] = get_footer_fixed_menu();
  //Load footer destination
  $variables['footer_destinations_menu'] = Destination::GetFooterDestinations();
  //Load footer hotels
  $variables['footer_hotels_menu'] = Hotel::GetFooterHotels();
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function feflip_preprocess_maintenance_page(&$variables) {
  // By default, site_name is set to Drupal if no db connection is available
  // or during site installation. Setting site_name to an empty string makes
  // the site and update pages look cleaner.
  // @see template_preprocess_maintenance_page
  if (!$variables['db_is_active']) {
    $variables['site_name'] = '';
  }
  drupal_add_css(drupal_get_path('theme', 'feflip') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function feflip_process_maintenance_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

function feflip_preprocess_user_profile(&$variables)
{
    if(isset($variables['user'])) {
        $loadUser = user_load($variables['user']->uid);
        $variables['loadUser'] = $loadUser;
    }
    $images = array();
    $images[] = array('url' => 'http://placehold.it/1280x800',
        'text' => 'User profile',
        'size' => array(1280,800));//getimagesize('http://placehold.it/1280x800'));
    $variables['slideImages'] = $images;
    $variables['main_navigation'] = get_header_main_navigation_menu();
}

/**
 * Override or insert variables into the node template.
 */
function feflip_preprocess_node(&$variables) {
         
  if (isset($variables['node']) && ($variables['node']->type == 'page')) {
        $variables['theme_hook_suggestions'][] = 'node__static';
        $variables['slideImages'] =  Helpers::GetAllImagesFromFieldCollection($variables['node']->field_images, $variables['node']->title, 'http://placehold.it/1280x800', 'headerslideshow');
  }
  elseif (isset($variables['node']) && ($variables['node']->type == 'hotel')){
      //Get navigation
      $urls = Hotel::NextPreviousUrlHotel($variables['node']);
      $variables['images'] = Hotel::GetImages($variables['node']);
      $variables['features'] = Hotel::GetContentBlocks($variables['node']);
      $variables['next'] = $urls['next'];
      $variables['previous'] = $urls['previous'];
      $variables['hotelreviews'] = url('node/'.$variables['node']->field_destination['und'][0]['entity']->nid).'/hotel-reviews';
      $images = array();
      $images[] = Helpers::GetMainImageFromFieldCollection($variables['node']->field_images, $variables['node']->title,'http://placehold.it/1280x800', 'headerslideshow');
      $variables['slideImages'] = $images;
      $variables['destination'] = $variables['node']->field_destination['und'][0]['entity']->nid;
      $variables['internalId'] = $variables['node']->nid;
  }
  elseif (isset($variables['node']) && ($variables['node']->type == 'post')) {
    $variables['theme_hook_suggestions'][] = 'node__post';
  }
  
  //Load navigation main menu
  $variables['main_navigation'] = get_header_main_navigation_menu();
}

/* Add customized classes by block, view.. */
function feflip_preprocess_views_view(&$variables) {
  $view = $variables['view'];
  
  $destinations = NULL;
  
  $images = array();
  $images[] = array('url'     => 'http://placehold.it/1280x800',
                    'text'    => '',
                    'size' => array(1280,800));//getimagesize('http://placehold.it/1280x800'));
  
  
  // Home View
  if ($view->name == 'home' && $view->current_display == 'page') {

    /* 
    * Collect data for the destinations slideshow.
    */
    //$variables['home_dests_slideshow'] = get_home_destinations('promote_to_slideshow');
    //$variables['home_dests'] = get_home_destinations();
    //$variables['home_dests_map'] = get_home_destinations('promote_to_map');

    $variables['slideImages'] = Destination::GetImagesForHomeSlideShow('view hotels');
    $destinations = Destination::GetAllDestination();
    $variables['destinations'] = $destinations;
    $variables['travel_journal'] = views_embed_view('travel_journal', 'page');
    $variables['main_navigation'] = get_header_main_navigation_menu($destinations);
  }
  elseif (($view->name == 'travel_journal' || $view->name == 'travel_journal_tags') && $view->current_display == 'page') {
    if (!empty($view->result)){
        //$post = array_shift($view->result);

        //find first post with image
        for($i=0; $i<count($view->result); $i++)
        {
            $post = $view->result[$i];
            if(isset($post->field_field_original_image[0]['raw']['safe_value'])
                && !empty($post->field_field_original_image[0]['raw']['safe_value'])
                && strlen($post->field_field_original_image[0]['raw']['safe_value']) > 0) break;
        }

        if (isset($post)) {
            $orig_date = strtotime($post->field_field_original_pubdate[0]['raw']['safe_value']);
            $images = array(array(
                'url' => $post->field_field_original_image[0]['raw']['safe_value'],
                'text' => $post->node_title,
                'size' => (!empty($post->field_field_original_image[0]['raw']['safe_value']) ? getimagesize($post->field_field_original_image[0]['raw']['safe_value']) : array(0, 0)),
                'linkto' => $post->field_field_original_url[0]['raw']['safe_value'],
                'btntext' => 'read more',
                'subtitle' => date('F, Y', $orig_date)
            ));
        }
        $variables['blank'] = true;
        $variables['main_navigation'] = get_header_main_navigation_menu();
        $variables['slideImages'] = $images;
    }
  }
  elseif ($view->name == 'hotel_reviews' && $view->current_display == 'page'){
    
      $variables['hotels'] = Hotel::HotelReviews($variables);
      $variables['main_navigation'] = get_header_main_navigation_menu();
      if(isset($variables['view']->args[0]))
      {
          $destination = node_load($variables['view']->args[0]);
          $images = Destination::GetAllImagesDestination($destination,'hotel reviews');
          $variables['destinationId'] = $destination->nid;
      }
      $variables['slideImages'] = $images;
  }
  elseif($view->name == 'itineraries' && $view->current_display == 'page'){
      $variables['itinerary'] =  Itinerary::ItinerariesInfo($view);
      $variables['main_navigation'] = get_header_main_navigation_menu();
      if(isset($variables['view']->args[0]))
      {
          $destination = node_load($variables['view']->args[0]);
          // weather code
          $wrapper = entity_metadata_wrapper('node', $destination);
          $variables['weather_id'] = $wrapper->field_weather_id->value();

          $images = Destination::GetAllImagesDestination($destination,$variables['itinerary']['name']);
          // check if exist term with this destination name
          $term = taxonomy_get_term_by_name($destination->title);
          if (!empty($term)) {
            $cat = array_shift($term);
            $variables['travel_journal'] = views_embed_view('travel_journal_tags', 'page', $cat->tid);
          }
          // get hotels view for current destination
          $variables['hotels'] = views_embed_view('hotel_reviews', 'page', $variables['view']->args[0]);
      }
      $variables['slideImages'] = $images;
  }
  elseif($view->name == 'map_it' && $view->current_display == 'page') {
      $variables['slideImages'] = Destination::GetImagesForHomeSlideShow('view hotels');
      $destinations = Destination::GetAllDestination();

      $destinationbycontinent = array();
      foreach ($destinations as $destination)
          $destinationbycontinent[$destination['continent']][] = $destination;

      //Añadimos los continentes que no tienen hoteles tambien
      /*$continents = Destination::GetContinents();
      $keys = array_keys($continents);
      foreach($keys as $key)
          if (!isset($destinationbycontinent[$continents[$key]]))
              $destinationbycontinent[$continents[$key]][] = null;*/

      $variables['destinationsbycontinent'] = $destinationbycontinent;
      $variables['destinations'] = $destinations;
      $variables['main_navigation'] = get_header_main_navigation_menu($destinations);
  }
    elseif($view->name == 'booking_info' && $view->current_display == 'page')
    {
        $booking = array(
            'id'=>'...',
            'firstName' => '...',
            'lastName' => '...',
            'mail' => '...',
            'phone'=> '...',
            'hotelName' => '...',
            'checkIn' => '...',
            'checkOut'=> '...',
            'rate' => '...',
            'creditCard' => '...',
            'roomType' => '...',
            'nights' => '...',
            'rooms' => '...',
            'adults' => '...',
            'children' => '...',
            'nightlyRates' => array(),
            'taxRate' => '...',
            'cancellationPolicy' => '...',
            'confirmationNumber' => '...',
            'address' => '',
            'cityCode' => '',
            'postalCode' => ''
        );

        if (count($view->result) > 0 && isset($view->result[0]->_field_data['entityform_id']['entity']))
        {
            $entity = $view->result[0]->_field_data['entityform_id']['entity'];

            $nightlyRates = array();
            $numNights = 0;

            if (isset($entity->field_nights['und'][0]['value']) && isset($entity->field_service['und'][0]['value']) && $entity->field_service['und'][0]['value'] == 'expedia' )
            {
                $rates = explode("|", $entity->field_nights['und'][0]['value']);
                if (isset($rates) && is_array($rates) && count($rates) > 0)
                {
                    $nightlyRates = $rates;
                    $numNights = count($rates);
                }
                else
                {
                    $numNights = $entity->field_nights['und'][0]['value'];
                }
            }
            else
            {
                $numNights = $entity->field_nights['und'][0]['value'];
            }


            $booking['id'] =  isset($entity->field_booking_id['und'][0]['value']) ? $entity->field_booking_id['und'][0]['value'] : '...';
            $booking['firstName'] =  isset($entity->field_first_name['und'][0]['value']) ? $entity->field_first_name['und'][0]['value'] : '...';
            $booking['lastName'] =  isset($entity->field_last_name ['und'][0]['value']) ? $entity->field_last_name ['und'][0]['value'] : '...';
            $booking['phone'] = isset($entity->field_phone_number ['und'][0]['value']) ? $entity->field_phone_number ['und'][0]['value'] : '...';
            $booking['mail'] =  isset($entity->field_email ['und'][0]['value']) ? $entity->field_email ['und'][0]['value'] : '...';
            $booking['hotelName'] =  isset($entity->field_hotel_name['und'][0]['value']) ? $entity->field_hotel_name['und'][0]['value'] : '...';
            $booking['checkIn'] =  isset($entity->field_check_in['und'][0]['value']) ? $entity->field_check_in['und'][0]['value'] : '...';
            $booking['checkOut'] =  isset($entity->field_check_out['und'][0]['value']) ? $entity->field_check_out['und'][0]['value'] : '...';
            $booking['rate'] =  isset($entity->field_rate['und'][0]['value']) ? $entity->field_rate['und'][0]['value'] : '...';
            $booking['creditCard'] =  isset($entity->field_credit_card['und'][0]['value']) ? $entity->field_credit_card['und'][0]['value'] : '...';
            $booking['roomType'] =  isset($entity->field_room_type['und'][0]['value']) ? $entity->field_room_type['und'][0]['value'] : '...';
            $booking['nights'] =  $numNights;
            $booking['nightlyRates'] = $nightlyRates;
            $booking['taxRate'] = isset($entity->field_tax_rate['und'][0]['value']) ? $entity->field_tax_rate['und'][0]['value'] : '...';
            $booking['cancellationPolicy'] = isset($entity->field_policy_cancel['und'][0]['value']) ? $entity->field_policy_cancel['und'][0]['value'] : '...';
            $booking['confirmationNumber'] = isset($entity->field_confirmation_number['und'][0]['value']) ? $entity->field_confirmation_number['und'][0]['value'] : '...';
            $booking['rooms'] =  isset($entity->field_rooms['und'][0]['value']) ? $entity->field_rooms['und'][0]['value'] : '...';
            $booking['adults'] =  isset($entity->field_adults['und'][0]['value']) ? $entity->field_adults['und'][0]['value'] : '...';
            $booking['children'] =  isset($entity->field_children['und'][0]['value']) ? $entity->field_children['und'][0]['value'] : '...';
            $booking['service'] =  isset($entity->field_service['und'][0]['value']) ? $entity->field_service['und'][0]['value'] : '...';
            $booking['address'] = isset($entity->field_adress_1['und'][0]['value']) ? $entity->field_adress_1['und'][0]['value'] : '';
            $booking['cityCode'] = isset($entity->field_citycode['und'][0]['value']) ? $entity->field_citycode['und'][0]['value'] : '';
            $booking['postalCode'] = isset($entity->field_postal_code['und'][0]['value']) ? $entity->field_postal_code['und'][0]['value'] : '';
            $booking['cancellationNumber'] = isset($entity->field_cancellation_number['und'][0]['value']) ? $entity->field_cancellation_number['und'][0]['value'] : '';
        }

        $variables['booking'] = $booking;
        $variables['slideImages'] = $images;
        $variables['main_navigation'] = get_header_main_navigation_menu($destinations);
    }
  
}

/**
 * Implements hook_form_alter().
 */
function feflip_form_alter(&$form, $form_state, $form_id) {
  if ($form_id == 'user_login_block' || $form_id == 'user_login') {
    $form['#attributes']['class'] = 'sign-in';
    $form['#attributes']['rel'] = 'no-follow';

    unset($form['name']['#title']);
    $form['name']['#attributes']['placeholder'] = 'e-mail or username';
    $form['name']['#description'] = '';

    unset($form['pass']['#title']);
    $form['pass']['#description'] = '';
  }
}

/**
 * Implements theme_form().
 * Remove extra div and add content for login form
 */
function feflip_form($variables)
{
  $element = $variables['element'];
  if (isset($element['#action'])) {
    $element['#attributes']['action'] = drupal_strip_dangerous_protocols($element['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element['#attributes']['accept-charset'])) {
    $element['#attributes']['accept-charset'] = "UTF-8";
  }
  if ($element['#form_id'] == 'search_api_page_search_form'){
    $element['#children'] = strip_tags($element['#children'], '<label><input>');
    $element['#attributes']['id'] = 'search';
    return '<form' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</form>';
  }
  elseif (in_array($element['#form_id'], array('user_login', 'user_login_block'))) {
    $f  = '<form' . drupal_attributes($element['#attributes']) . '><div id="already-a-member">' . $element['#children'] . '</div>';
    $f .= '<div id="upgrade"><h4>you deserve an upgrade</h4><h5>create a free membership to access insider-only hotel rates not available to the public.</h5><a href="/user/register" class="rounded-btn">free membership</a></div>';
    $f .= '</form>';
    return $f;
  }
  else {
  // Custom div wrapper
    return '<form' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</form>';
  }
}

/**
 * Implements theme_container().
 * removing submit wrappers
 */
function feflip_container($variables) {
  $element = $variables['element'];
  // Ensure #attributes is set.
  $element += array('#attributes' => array());

  // Special handling for form elements.
  if (isset($element['#array_parents'])) {
    // Assign an html ID.
    if (!isset($element['#attributes']['id'])) {
      $element['#attributes']['id'] = $element['#id'];
    }
    // Add the 'form-wrapper' class.
    $element['#attributes']['class'][] = 'form-wrapper';
  }
  return $element['#children'];
}

/**
 * Implements theme_form_element().
 * removing inputs wrappers
 */
function feflip_form_element($variables)
{
  $element = &$variables['element'];

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
    );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }

  $output = '';

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
    $output .= ' ' . theme('form_element_label', $variables);
    $output .= ' ' . $element['#children'];
    break;

    case 'after':
    $output .= ' ' . $element['#children'];
    $output .= ' ' . theme('form_element_label', $variables) . "\n";
    break;

    case 'none':
    case 'attribute':
    // Output no label and no required marker, only the children.
    $output .= ' ' . $element['#children'];
    break;
  }
  return $output;
}

/**
 * Implements theme_field__field_type().
 */
function feflip_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}

/**
 * Implements hook_theme().
 */
function feflip_theme() {
  $items = array();
 
  $items['user_pass_reset'] = array(
    'render element' => 'form',
    'template' => 'templates/user-pass'
  );

  $items['user_pass'] = array(
    'render element' => 'form',
    'template' => 'templates/user-profile'
  );    

  $items['user_profile_form'] = array(
    'render element' => 'form',
    'template' => 'templates/user-profile-edit'
  );  
  return $items;
}

/* 
* Get destinations promoted to front page
* @param filter_field
* @return array()
*/
function get_home_destinations($filter_field = 'promote') {
  /*
  * Get destinations promoted to frontpage altering the existing 'start_your_journey' view
  * adding the promoted filter.
  * 
  */
  $dest_view = views_get_view('start_your_journey');
  // add filter criteria
  $dest_view->set_display('page');
  $dest_view->add_item($dest_view->current_display, 'filter', 'node', $filter_field, array('operator' => '=','value' => 1));
  $dest_view->preview();

  return $dest_view->result;
}

/*
 * Get main navigation menu for header
 * @return string
 */
function get_header_main_navigation_menu($destinations=NULL){
  
  if (!isset($destinations))
      $destinations =  Destination::GetAllDestination();
    
  $navigationMenu = '<ul>'; 
  
  $main_menu = menu_tree_all_data('menu-main-navigation');
  
  foreach ($main_menu as $key => $menu_item)
  {

    // if user is logged in and is the 'my account' item, render user menu inside
    if (strpos($key, '1703') !== FALSE)
    {
      if (user_is_logged_in())
      {
        $navigationMenu .= '<li><a href="'.url($menu_item['link']['link_path']).'">'.$menu_item['link']['link_title'].'</a>';
          if(isset($menu_item['below']) && count($menu_item['below']) > 0) {
              /*$navigationMenu .= '<ul id="itinerary-list">';
              foreach ($menu_item['below'] as $submenuItem) {
                  $navigationMenu .= '<li><a href="'. url($submenuItem['link']['link_path']).'">'.$submenuItem['link']['link_title'].'</a></li>';
              }
              $navigationMenu .= '</ul>';*/

              $featherUser = Helpers::GetFeatherFlipUser();
              $bookings = Helpers::GetBookingInfoByUser();

              $navigationMenu .= '<div id="user-profile">
							<div id="bookings">
								<div class="bg"></div>
								<h4>My Bookings</h4>';
              foreach($bookings as $booking)
              {
                  if (isset($booking->field_booking_id['und'][0]['value']))
                    $navigationMenu .= '<h5><a href="/booking-info/' . $booking->field_booking_id['und'][0]['value'] . '">Booking ' . $booking->field_booking_id['und'][0]['value'] . '</a></h5>';
                  //<h5>Booking 13324432342wwrer33543dwwr / 12/02</h5>
                  //<h5>Booking 13324432342wwrer33543dwwr</h5>
              }

              $navigationMenu .= '</div>
							<div id="profile">
								<h4>'. $featherUser->name .'</h4>
								<h5>Change password <button id="change-password">HERE</button></h5>
								<a href="/user/logout">log out</a>
							</div>
						</div>';
          }
      }
      /*
      else
      {
        $navigationMenu .= '<li><a href="'.url($menu_item['link']['link_path']).'">'.$menu_item['link']['link_title'].'</a>';
        // TODO: get feather and flip login form
        $form = drupal_get_form('user_login');
        $navigationMenu .= drupal_render($form);
      }*/
    }
    else
    {

      $navigationMenu .= '<li><a href="'.url($menu_item['link']['link_path']).'">'.$menu_item['link']['link_title'].'</a>';
        
      //only for hotel reviews and itineraries
      if ((strpos($key, '2029') !== FALSE || strpos($key, '1701') !== FALSE) && count($destinations) > 0)
      {
           $navigationMenu .= '<ul id="'.$menu_item['link']['options']['attributes']['title'].'">';
           foreach($destinations as $destination)
           {
               $navigationMenu .= '<li><a href="'. $destination['url'] . (strpos($key, '2029') !== FALSE ? '/hotel-reviews' : '/itinerary').'">'.$destination['withcountry'].'</a></li>';
           }
           
           $navigationMenu .= '</ul>';
      }
    }
    $navigationMenu .= '</li>';
  }
  
  $navigationMenu .= '</ul>';
  
  return $navigationMenu;
}


/*
 * Get fixed menu in footer
 * @return string
 */
function get_footer_fixed_menu() {
  $f_menu = menu_tree_all_data('menu-footer-right');
  $output = '<ul>';
  $output .= '<li><span class="icon ff"></span>feather + flip</li>';
  foreach ($f_menu as $key => $menu_item) {
      if ((strpos($key, '2205') !== FALSE) || (strpos($key, '2208') !== FALSE))
          $output .= '<li><a href="' . url($menu_item['link']['link_path']) . '" target="_blank">' . $menu_item['link']['link_title'] . '</a></li>';
      else
          $output .= '<li><a href="' . url($menu_item['link']['link_path']) . '">' . $menu_item['link']['link_title'] . '</a></li>';
  }
  $output .= '</ul>';
  return $output;
}

// replace some metatags
function feflip_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array (
    'charset' => 'utf-8'
    );
  // Force global language metatag
  $head_elements['language_global_metatag'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array('content' => 'en', 'name' => 'language'),
    );
  // Force global viewport metatag
  // $head_elements['viewport_metatag'] = array(
  //  '#type' => 'html_tag',
  //  '#tag' => 'meta',
  //  '#attributes' => array('content' => 'initial-scale=1, minimum-scale=1, width=device-width', 'name' => 'viewport'),
  //  );
  // Force the latest IE rendering engine and Google Chrome Frame.
  $head_elements['chrome_frame'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'),
    );
}

// Generate share links
function getSocialLink($_network,$url, $img = '', $desc = '')
{
  if (strpos($url, 'http://') === false)
    $url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$url;
  switch($_network){
    case 'facebook':
    return 'http://www.facebook.com/sharer.php?u='.urlencode($url);
    break;
    case 'twitter':
    return "https://twitter.com/share?url=".urlencode($url);
    break;
    case 'pinterest':
    return "http://pinterest.com/pin/create/button/?url=".urlencode($url)."&media=".$img."&description=".urlencode($desc);
    break;
    case 'google+':
    return "https://plus.google.com/share?url=".urlencode($url);
    break;
    break;
  }
}