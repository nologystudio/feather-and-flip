<?php

	// Receive and call to needed function for each form
	if (isset($_POST['formID']) && !empty($_POST['formID'])){

        global $base_url;
        $base_url = 'http://'.$_SERVER['HTTP_HOST'];

		// Drupal Bootstrap
		$drupal_path = $_SERVER['DOCUMENT_ROOT'];
        chdir($drupal_path);
		define('DRUPAL_ROOT', getcwd());
		require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
		drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
        drupal_settings_initialize();

		//watchdog('FormsController', 'formID ===> '.$_POST['formID']);

		$form_id = $_POST['formID'];

		$input_values = array();
		foreach ($_POST as $key => $value) {
			if ($key != 'formID')
				$input_values[$key] = $value;
		}

		switch ($form_id) {
			case 'signup':
                $result = AdminForms::signUpUser($input_values, $error);
                $obj = array('result'=>$result, 'error'=>$error);
				echo json_encode($obj);
				break;
			case 'signin':
                $result = AdminForms::signInUser($input_values,$error);
                $obj = array('result'=>$result, 'error'=>$error);
                echo json_encode($obj);
				break;
            case 'logout':
                $result = AdminForms::logOutUser($error);
                $obj = array('result' => $result, 'error' => $error);
                echo json_encode($obj);
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