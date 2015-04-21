<?php 

	// Redirect to destination/itinerary url
	$wrapper = entity_metadata_wrapper('node', $node);
	$dest = $wrapper->field_destination->value();
	$url = drupal_get_path_alias('node/'.$dest->nid.'/itinerary');
	drupal_goto($url);
?>