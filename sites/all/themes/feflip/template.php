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
        //AboutUs->nid=27
        $static_nodes = array('html__node__27');
        $arg = arg();

        variable_set('pageID', 'global');
	if (drupal_is_front_page())
	    variable_set('pageID', 'home');
        else if (isset($arg[2]) && $arg[2] == 'hotel-reviews')
            variable_set('pageID', 'hotel-reviews');
        else if (isset($arg[2]) && $arg[2] == 'itineraries')
            variable_set('pageID', 'itinerary');
        else{
          
          foreach($variables['theme_hook_suggestions'] as $item)
          {
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

  //Load navigation main menu
  $variables['main_navigation'] = get_header_main_navigation_menu();
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

/**
 * Override or insert variables into the node template.
 */
function feflip_preprocess_node(&$variables) {
 
  if (isset($variables['node']) && ($variables['node']->type == 'page')) {
	$variables['theme_hook_suggestions'][] = 'node__static';
}

}

/* Add customized classes by block, view.. */
function feflip_preprocess_views_view(&$variables) {
  $view = $variables['view'];

  // Home View
  if ($view->name == 'home' && $view->current_display == 'page') {

    /* 
    * Collect data for the destinations slideshow.
    */
    $variables['home_dests_slideshow'] = get_home_destinations('promote_to_slideshow');
    $variables['home_dests'] = get_home_destinations();
    $variables['home_dests_map'] = get_home_destinations('promote_to_map');
  }
  else if ($view->name == 'hotel_reviews' && $view->current_display == 'page'){
    
    $variables['hotels'] = Hotel::HotelReviews($variables);
  }
  else if($view->name == 'itineraries' && $view->current_display == 'page'){
    $variables['itinerary'] =  Itinerary::ItinerariesInfo($view);
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
function get_header_main_navigation_menu(){
  
  $destinations =  Destination::getAllDestinationTileCountry();
    
  $navigationMenu = '<ul>'; 
  
  $main_menu = menu_tree_all_data('menu-main-navigation');
  
  foreach ($main_menu as $key => $menu_item) {

    // if user is logged in and is the 'join-us' item, render user menu inside
    if (strpos($key, '1703') !== FALSE) {
      if (user_is_logged_in()){
        $navigationMenu .= '<li><a href="'.url('user').'">My Account</a>';
        // TODO: get user menu
      } else {
        $navigationMenu .= '<li><a href="'.url($menu_item['link']['link_path']).'">'.$menu_item['link']['link_title'].'</a>';
        // TODO: get feather and flip login form
        $form = drupal_get_form('user_login');
        $navigationMenu .= drupal_render($form);
      }
    } else {

      $navigationMenu .= '<li><a href="'.url($menu_item['link']['link_path']).'">'.$menu_item['link']['link_title'].'</a>';
        
      //only for hotel reviews and itineraries
      if ((strpos($key, '2029') !== FALSE || strpos($key, '1701') !== FALSE) && count($destinations) > 0)
      {
           $navigationMenu .= '<ul id="'.$menu_item['link']['options']['attributes']['title'].'">';
           foreach($destinations as $destination)
           {
               $navigationMenu .= '<li><a href="'. $destination['url'] . (strpos($key, '2029') !== FALSE ? '/hotel-reviews' : '/itinerary').'">'.$destination['destination'].'</a></li>';
           }
           
           $navigationMenu .= '</ul>';
      }
    }
    $navigationMenu .= '</li>';
  }
  
  $navigationMenu .= '</ul>';
  
  return $navigationMenu;
}
