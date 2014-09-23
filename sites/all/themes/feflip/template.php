<?php

/**
 * @file
 * This file contains the main theme functions hooks and overrides.
 */

/**
 * Override or insert variables into the html template.
 */
function feflip_preprocess_html(&$vars)
{
	$service = wsclient_service_load('sabre__rest');
	var_dump($service);
}
