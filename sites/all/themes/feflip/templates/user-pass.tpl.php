<?php
$arg = arg();

if (isset($arg[0]) && $arg[0] == 'user' && isset($arg[1]) && $arg[1] == 'reset' && isset($arg[2]) && isset($arg[3]) && isset($arg[4])) {
	
	$form_state = array(
		"build_info" => array(
			"args" => array($arg[2], $arg[3], $arg[4]),
			"form_id" => "user_pass_reset",
			"files" =>array(
				"menu" => "modules/user/user.pages.inc"
			)
		),
		"rebuild" => false,
		"rebuild_info" => array(),
		"redirect" => NULL,
		"temporary" => array(),
		"submitted" => false,
		"executed" => false,
		"programmed" => false,
		"programmed_bypass_access_check" => true,
		"cache" => false,
		"method" => "post",
		"groups" => array(),
		"buttons" => array(),
		"input" => array()
	);
	drupal_build_form('user_pass_reset', $form_state);
	$query = '';
	foreach ($form_state['values'] as $key => $value) {
		$query .= $key.'='.$value.'&';
	}
	$query = rtrim($query, '&');
	// $time = time();
	// user_pass_reset($form, $form_state, $arg[2], $time, $arg[4], 'login');
	//drupal_form_submit('user_pass_reset', $form_state);
	//form_execute_handlers('submit', $form, $form_state);

	// $options = array(
	// 	'method' => 'POST',
	// 	'data' => $query,
	// 	'headers' => array('Content-Type' => 'application/x-www-form-urlencoded'),
	// );

	// $result = drupal_http_request('http://'.$_SERVER['HTTP_HOST'].$form['#action'], $options);
	// if (isset($result->redirect_url))
	// 	drupal_goto($result->redirect_url);
}




?>