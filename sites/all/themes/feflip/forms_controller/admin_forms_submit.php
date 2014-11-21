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
			case 'signup':
				$result = AdminForms::signUpUser($input_values);
				echo json_encode($result);
				break;
			case 'signin':
				break;
			case 'getDestinations':
				$result = AdminForms::getDestinations();
				echo json_encode($result);
				break;
			case 'hotelRates': 
				$result = AdminForms::getHotelRates($input_values);
				echo json_encode($result);
				break;
			case 'newsletterForm':
			    // Connect with mailchimp library
			    if (AdminForms::subscribeToNewsLetter($input_values, $error))
			    {
			        echo 'All right you are subscribe.';
			    }
			    else
			    {
			        echo '<b>Error:</b>&nbsp;' . $error;
			    }
			break;			
			default:
			break;
		}
	}

?>