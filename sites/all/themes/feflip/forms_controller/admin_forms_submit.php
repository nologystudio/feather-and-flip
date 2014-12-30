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
                $nextPage = '';
                //watchdog('Admin Forms Submit', 'HotelRates ===> '. '<pre>' . print_r( $input_values, true) . '</pre>');
                //Caso del home al hotelreview y del hotelreview al hotelreview
                $destination = $input_values['destination'];
                if(isset($destination) && !empty($destination))
                {
                    $codes = Hotel::GetHotelCodesByDestination($destination);
                    $next = drupal_get_path_alias('node/'. $destination . '/hotel-reviews');
                }
                //Caso del node hotel
                else
                {
                    $codes['sabre'][] = $input_values['sabreCode'];
                    $codes['expedia'][] = $input_values['expediaCode'];
                }

                //Pass sabre and ean code by parameters
                $input_values['sabreCodes'] = $codes['sabre'];
                $input_values['eanCodes'] = $codes['expedia'];
                //Web service call
                $result = AdminForms::getHotelRates($input_values);

                $_SESSION['hotelRates'] = $result;
                $_SESSION['inputValues'] = $input_values;

                echo $next;

                break;
            case 'hotelDescription':
                $nextPage = '';
                $result = AdminForms::getHotelDescription($input_values);
                $_SESSION['hotelDescription'] = $result;
                $_SESSION['inputValues'] = $input_values;
                $nextPage = drupal_get_path_alias('node/' . $input_values['internalId']);
                echo $nextPage;
                //echo json_encode($result);
                break;
            case 'hotelBooking':
                $res = AdminForms::hotelBookingReservation($input_values);
                if (!empty($res['args']))
                    feflip_features_StoreBooking($res['args']);
                echo json_encode($res['result']);
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
            case 'customSearch':
                $result = AdminForms::CustomSearch($input_values['key']);
                echo json_encode($result);
                break;
			default:
			break;
		}
	}

?>