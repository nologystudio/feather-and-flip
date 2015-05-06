<?php

/*
 * potential problems
 * @todo we use LANGUAGE_NONE everywhere...problem!
 * @todo using event CONTENT IS VIEWED slows down the node dramatically
 * @todo, what happens if we delete a node? The presets will not be deleted! hmm ...
 */

/*
 * INFO
 *
 * We let the user select the file scheme, so we could create the presets in the private file folder
 * eveb if the field is public. We do that to later add an access check on these presets.
 */


/**
 * @file
 * Rules code: actions for image styles.
 */

function rules_image_styles_rules_action_info() {

  $actions['rules_image_styles_action_generate'] = array(
    'label' => t('Pre generate image styles'),
    'group' => t('Image Styles'),
    'parameter' => array(
      'style_presets' => array(
        'type' => 'list<integer>',
        'label' => t('List of avaliable image styles'),
        'options list' => 'rules_image_styles_presets_list',
      ),
      'style_presets_schema' => array(
        'type' => 'list<integer>',
        'label' => t('Chose file Schema (ONLY CHOSE ONE)'),
        'options list' => 'rules_image_styles_schema_list',
      ),
      'style_presets_subfolder' => array(
        'type' => 'text',
        'label' => t('Subfolder'),
        'description' => t("<strong>No leading or trailing slash!</strong>. You may want to chose a subfolder where the styles are generated into. For example Use styles if you want them generated into sites/default/files/styles (sites/default/files is the private file basedir here)"),
        'optional' => TRUE,
      ),
      //pass in the node too, because we need to whole node object for token_replace
      'node' => array(
        'type' => 'node',
        'label' => t('Content'),
        'save' => TRUE,
      ),
    ),
  );

  return $actions;
}


/**
 * Generating the image styles
 *
 * We passed in the node object. Take all imagefields of the node and render all chosen presets
 */
function rules_image_styles_action_generate($selected_image_styles, $scheme, $subfolder, $node) {
  generateImages($node, $selected_image_styles);
  $b = 1;
}


/***************************************************************************************************
 *      HELPER DUNCTIONS
 **************************************************************************************************/


/**
 * Helper function to build a select list for all image styles
 *
 * @return <array>
 *   An array with all image styles
 *
 * Why not use: image_style_options? -> keys will be saved 0 1 2 3..useless
 */
function rules_image_styles_presets_list() {
  $image_styles = array();
  foreach (image_styles() as $name => $settings) {
    $image_styles[$name] = $name;
  }
  return $image_styles;
}

/**
 * Helper function to build a select list for all image styles
 *
 * @return <array>
 *   An array with all image styles
 *
 * Why not use: image_style_options? -> keys will be saved 0 1 2 3..useless
 */
function rules_image_styles_schema_list() {
  $scheme = array(
    'public' => 'public',
    'private' => 'private',
  );

  return $scheme;
}

/**
 * Helper function to build a select list for all node types
 *
 * @return <array>
 *   An array with all node types
 */
/*function rules_image_styles_node_types() {
  $node_types = array();
  foreach (node_type_get_types() as $obj_name => $settings) {
    $node_types[$settings->type] = $settings->name;
  }
  return $node_types;
}*/

/*
 * Helper function to only get image_fields
 *
 * @params node
 *  a node object
 * @return <array>
 *   An array with all avaliable imagefields in all nodes
 */

function rules_image_styles_action_get_node_image_fields($node) {
  $image_fields = array();

  $node_fields = field_info_instances('node', $node->type);

  foreach ($node_fields as $name => $field_data) {
    //we check the widget here, is there a better solution? May this cause problems?
    if ($field_data['widget']['module'] == 'image') {
      $image_fields[$name] = $field_data;
    }
  }

  return $image_fields;
}


function generateImages($node, $selected_image_styles) {
  if ($node->type == 'hotel') {
    $fieldCollection = $node->field_images_cdn;
    if (isset($fieldCollection['und']) && count($fieldCollection['und']) > 0) {
      foreach ($fieldCollection['und'] as $item) {
        $imageItems = entity_load('field_collection_item', array($item['value']));
        $imageItems = array_shift($imageItems);

        if (isset($imageItems->field_image_cdn['und']) && count($imageItems->field_image_cdn['und']) > 0) {
          foreach ($imageItems->field_image_cdn['und'] as $image) {
            foreach ($selected_image_styles as $key => $style) {
              $url = image_style_url($style, $image['uri']);
              if (strpos($url, 'system/files/styles')) {
                //FIXME background resize image
                execBackgroundResize($url);
              }
              //FIXME if url haven't contain 's3' string is necessary generate it.
//              openURL($url);

              /*
               * $original = file_load($fid);
foreach ($styles as $style_name) {
  $derivative_uri = image_style_path($style_name, $original->uri);
  image_style_create_derivative($style_name, $original->uri, $derivative_uri);
}
               */
            }
          }
        }
      }
    }
  }
  /*
   $images = array();

   if (isset($fieldCollection['und']) && count($fieldCollection['und']) > 0)
   {

     foreach($fieldCollection['und'] as $item)
     {
       $imageItems = entity_load('field_collection_item',array($item['value']));
       $imageItems = array_shift($imageItems);

       if (isset($imageItems->field_image_cdn['und']) && count($imageItems->field_image_cdn['und']) > 0)
       {
         foreach($imageItems->field_image_cdn['und'] as $image)
         {
           $url = image_style_url($style,$image['uri']);
  */
}

function execBackgroundResize($url) {
  $command = "curl " . 'http://apellido.enfemenino.com/w/apellidos/apellido-asdasda.html';
  exec("$command > /dev/null &", $arrOutput);
  /*
  //FIXME cambiar la url para que el puerto sea el 81
  $value = str_replace('http://localhost:8123/', 'http://develop-env-gh9776spcg.elasticbeanstalk.com/', $url);
  $command = "curl " . $value;
  exec("$command > /dev/null &", $arrOutput);
  */
  $a = 1;
}