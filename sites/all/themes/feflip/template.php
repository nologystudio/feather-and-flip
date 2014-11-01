<?php

/**
 * Add body classes if certain regions have content.
 */
function feflip_preprocess_html(&$variables) {
        $productionURL  = 'feather+flip.com';
        $uriSplitter    = explode('/',$_SERVER['REQUEST_URI']);
        $url            = ($_SERVER['HTTP_HOST'] == $productionURL) ? '' : $uriSplitter[1].'/sites/all/themes/feflip'; 
        $relativePath   = $url.'/';  
  
        variable_set('relativePath', $relativePath);
        
        variable_set('pageID', 'global');
	if (drupal_is_front_page())
	    variable_set('pageID', 'home');
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
}

/**
 * Implements hook_form_alter().
 */
function feflip_form_alter(&$form, $form_state, $form_id) {
  if ($form_id == 'user_login_block' || $form_id == 'user_login') {
    $form['#attributes']['class'] = 'sign-in';
    //TODO: customize login form
    unset($form['name']['#title']);
    $form['name']['#attributes']['placeholder'] = 'e-mail or username';
    $form['name']['#description'] = '';

    unset($form['pass']['#title']);
    $form['pass']['#description'] = '';

    $form['links']['#markup'] = '<div id="upgrade">
    <h4>you deserve an upgrade</h4>
    <h5>create a free membership to access insider-only hotel rates not available to the public.</h5>
    <a href="" class="rounded-btn">free membership</a>
    </div>';
  }
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
      if ((strpos($key, '1700') !== FALSE || strpos($key, '1701') !== FALSE) && count($destinations) > 0)
      {
           $navigationMenu .= '<ul id="'.$menu_item['link']['link_title'].'">';
           foreach($destinations as $destination)
               $navigationMenu .= '<li><a href="#">'.$destination.'</a></li>';
           
           $navigationMenu .= '</ul>';
      }
    }
    $navigationMenu .= '</li>';
  }
  
  $navigationMenu .= '</ul>';
  
  return $navigationMenu;
}
