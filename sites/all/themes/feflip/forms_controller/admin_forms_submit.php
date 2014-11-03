<?php

	// Receive and call to needed function for each form
	if (isset($_POST['formID']) && !empty($_POST['formID'])){

		// Drupal Bootstrap
		$drupal_path = $_SERVER['DOCUMENT_ROOT'];
		define('DRUPAL_ROOT', $drupal_path);
		require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
		drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

		//watchdog('FormsController', 'formID ===> '.$_POST['formID']);

		$form_id = $_POST['formID'];
		$input_values = array();
		foreach ($_POST as $key => $value) {
			if ($key != 'formID')
				$input_values[$key] = $value;
		}

		switch ($form_id) {
			case 'bookingForm': //'customForm':

				break;
			case 'newsletterForm':
				// Connect with mailchimp library
				$result = AdminForms::subscribeToNewsLetter($input_values, $error);
			break;			
			default:
			break;
		}
	}

?>