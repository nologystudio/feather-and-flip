<?php

class AdminForms
{
    const API = 'Mailchimp.php';
    const APIKEY = 'eae1d5448b1a2cb751661162fd5011fd-us8';
    const LISTID = '487e37ac3f';


    private static function encrypt_decrypt($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = date('Y-m-d H:i:s');//'This is my secret key';
        $secret_iv = date('Y-m-d H:i:s');//'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }


    /**
     * Same function that drupal user.module, this function try load user by name if don't load a user try load by email
     * @param $name
     * @param $password
     * @return bool
     * @throws Exception
     */
    private static function user_authenticate($name, $password) {
        $uid = FALSE;
        if (!empty($name) && !empty($password)) {
            $account = user_load_by_name($name);
            if(!$account) $account = user_load_by_mail($name);
            if ($account) {
                // Allow alternate password hashing schemes.
                require_once DRUPAL_ROOT . '/' . variable_get('password_inc', 'includes/password.inc');
                if (user_check_password($password, $account)) {
                    // Successful authentication.
                    $uid = $account->uid;

                    // Update user to new password scheme if needed.
                    if (user_needs_new_hash($account)) {
                        user_save($account, array('pass' => $password));
                    }
                }
            }
        }
        return $uid;
    }

    /**
     * Subscribe new user to mailchimp news letter
     * @param $custom_data
     * @param $errorMsg
     * @return bool
     */
    static function subscribeToNewsLetter($custom_data, &$errorMsg)
    {
        if (!isset($custom_data['user_email'])) 
        {
            $errorMsg = "You must include an email.";
            return false;
        }

        require_once(self::API);

        try
        {

            $mailchimp = new Mailchimp(self::APIKEY);

            $values =array();
            //$values['FNAME']    = $custom_data['user_name'];
            $values['EMAIL']    = $custom_data['user_email'];            

            $resultado = $mailchimp->lists->subscribe(
                        self::LISTID,
                        array('email' => $values['EMAIL']),
                        $values
                        );

            if (isset($resultado['email']))
            {
                return true;
            }
            elseif (isset($result['status']) && $result['status'] === 'error')
            {
                if (isset($resultado['code']))
                    $errorMsg .= 'Code: ' . $resultado['code'] . ' ';
                if (isset($resultado['name']))
                    $errorMsg .= 'Name: ' . $resultado['name'] . ' ';
                if (isset($resultado['error']))
                    $errorMsg .= 'Error: ' . $resultado['error'];

                return false;
            }
            else
            {
                $errorMsg = "Unknow error.";
                return false;
            }  
        }  
        catch (Exception $e)
        {
           $errorMsg = 'Exception: ' . $e->getMessage();
           return false;
        }
    }


    /**
     * Returns hotels rates of expedia and sabre (call webservice)
     * @param $values
     * @return array
     */
    static function getHotelRates($values)
    {
        $sabreService = new Sabre;

        $date = explode("/", $values['checkIn']);
        $sabreChecking = $date[2].'-'. $date[0].'-'.$date[1];
        $date = explode("/", $values['checkOut']);
        $sabreCheckout = $date[2].'-'. $date[0].'-'.$date[1];

        // Sabre numAdults
        $numAdults = 0;
        foreach ($values['rooms']['info'] as $room) {
            $numAdults += $room['adults'];
            // adding children as adults
            //$numAdults += $room['children']['number'];
        }

        return array(
            'sabre' => $sabreService->ListHotelAvail($values['sabreCodes'], $numAdults, $sabreChecking, $sabreCheckout),
            'expedia' => Expedia::GetHotelsByCode_XML($values['eanCodes'], $values['checkIn'], $values['checkOut'], $values['rooms']['info'])
        );
    }

    /**
     * Returns rooms description of hotels (call webservice)
     * @param $values
     * @return array
     */
    static function getHotelDescription($values)
    {
        $date = explode("/", $values['checkIn']);
        $sabreChecking = $date[2].'-'. $date[0].'-'.$date[1];
        $date = explode("/", $values['checkOut']);
        $sabreCheckout = $date[2].'-'. $date[0].'-'.$date[1];

        // Sabre numAdults
        $numAdults = 0;
        foreach ($values['rooms']['info'] as $room) {
            $numAdults += $room['adults'];
            // adding children as adults
            //$numAdults += $room['children']['number'];
        }

        $service = isset($values['service']) ? $values['service'] : null;
        $hotelId = isset($values['hotelId']) ? $values['hotelId'] : null;

        if (isset($service) && isset($hotelId))
        {
            if ($service == 'sabre')
            {
                $sabreService = new Sabre;
                $sessionInfo = null;

                if (isset($_SESSION['sabreSession'])) {
                    try {
                        $sabreService->CloseSession($_SESSION['sabreSession']);
                    }catch(Exception $e){}
                }

                $sessionInfo = $sabreService->CreateSession();
                $_SESSION['sabreSession'] = $sessionInfo;

                return $sabreService->HotelDescription($sessionInfo, $hotelId, $numAdults, $sabreChecking, $sabreCheckout);
            }
            else
                return Expedia::RoomAvailability_XML($hotelId, $values['checkIn'], $values['checkOut'], $values['rooms']['info']);
        }

        /*
        return array(
            'sabre' => $sabreService->HotelDescription($sessionInfo, $values['hotelCode'], $numAdults, $sabreChecking, $sabreCheckout),
            'expedia' => Expedia::RoomAvailability($values['eanCode'], $values['checkIn'], $values['checkOut'], $values['rooms']['info'])
        );
        */
    }

    static function hotelBookingReservation($values)
    {
        $sabreService = new Sabre;

        $service = isset($values['service']) ? $values['service'] : null;


        $numAdults = 0;
        $numChildren = 0;

        /*
        foreach ($values['rooms']['info'] as $room) {
            $numAdults += $room['adults'];
            $numChildren += $room['children']['number'];
        }*/
        $args = array();
        if (isset($service) && $service == 'sabre')
        {
            $sessionInfo = $_SESSION['sabreSession'];

            $result = $sabreService->HotelBookReservation($sessionInfo,$values['roomCode'], $values['numUnit'], $values['firstName'], $values['lastName'], $values['email'], $values['phone'],
                $values['guaranteeType'], $values['creditCardCode'], $values['creditCardExpireDate'], $values['creditCardNumber']);

            if (isset($_SESSION['sabreSession'])) {
                try {
                    $sabreService->CloseSession($_SESSION['sabreSession']);
                    unset($_SESSION['sabreSession']);
                }catch(Exception $e){}
            }

            if (isset($result->ApplicationResults->Success) && isset($result->Hotel))
            {
                $args = array(
                    'user_first_name'=>$values['firstName'],
                    'user_last_name'=>$values['lastName'],
                    'user_email'=>$values['email'],
                    'user_phoneNumber' =>$values['phone'],
                    'user_creditCard' => 'xxxxxxxxxxxx'. substr($values['creditCardNumber'], -4),
                    'booking_id'=>$result->Hotel->BasicPropertyInfo->ConfirmationNumber,
                    'booking_hotelName'=>$result->Hotel->BasicPropertyInfo->HotelName,
                    'booking_hotelContact'=>'',
                    'booking_ckeckIn'=>$values['checkIn'],
                    'booking_checkOut'=>$values['checkOut'],
                    'booking_rate'=>$result->Hotel->RoomRates->RoomRate->Rates->Rate->Amount . ' ' . $result->Hotel->RoomRates->RoomRate->Rates->Rate->CurrencyCode,
                    'booking_roomType' => '',
                    'booking_nights' => $result->Hotel->TimeSpan->Duration,
                    'booking_rooms' => $result->Hotel->NumberOfUnits,
                    'booking_adults' => $numAdults,
                    'booking_children' => $numChildren
                );
            }

            return array('result' => $result, 'args' => $args);
        }
        else if (isset($service) && $service == 'expedia')
        {
            $date = explode("-", $values['creditCardExpireDate']);
            $creditCardExpirationMonth = $date[1];
            $creditCardExpirationYear = $date[0];

            $result = Expedia::HotelBookReservation($values['hotelId'], $values['checkIn'], $values['checkOut'], $values['rooms']['info'],
                $values['roomCode'], $values['rateCode'], $values['rateKey'], $values['supplierType'], $values['chargeableRate'], $values['firstName'], $values['lastName'], $values['email'], $values['phone'],
                $values['creditCardCode'], $values['creditCardNumber'], $values['creditCardIdentifier'], $creditCardExpirationMonth, $creditCardExpirationYear);


            if (isset($result['processedWithConfirmation']) && isset($result['reservationStatusCode']) && $result['reservationStatusCode'] == 'CF')
            {
                $args = array(
                    'user_first_name'=>$values['firstName'],
                    'user_last_name'=>$values['lastName'],
                    'user_email'=>$values['email'],
                    'user_phoneNumber' =>$values['phone'],
                    'user_creditCard' => 'xxxxxxxxxxxx'. substr($values['creditCardNumber'], -4),
                    'booking_id'=>$result['itineraryId'] . '-' . $result['confirmationNumbers'],
                    'booking_hotelName'=>$result['hotelName'],
                    'booking_hotelContact'=>'',
                    'booking_ckeckIn'=>$values['checkIn'],
                    'booking_checkOut'=>$values['checkOut'],
                    'booking_rate'=> $result['RateInfos']['RateInfo']['ChargeableRateInfo']['@Total'],
                    'booking_nights' => $result['RateInfos']['RateInfo']['ChargeableRateInfo']['NightlyRatesPerRoom']['@size'],
                    'booking_roomType' => $result['roomDescription'],
                    'booking_rooms' => $result['numberOfRoomsBooked'],
                    'booking_adults' => $result['RateInfos']['RateInfo']['RoomGroup']['Room']['numberOfAdults'],
                    'booking_children' => $result['RateInfos']['RateInfo']['RoomGroup']['Room']['numberOfChildren']
                );
            }

            return array('result' => $result, 'args' => $args);

            /*
            $confirmationNumber = uniqid();
            $args = array(
                'user_first_name'=>$values['firstName'],
                'user_last_name'=>$values['lastName'],
                'user_email'=>$values['email'],
                'user_phoneNumber' =>$values['phone'],
                'user_creditCard' => 'xxxxxxxxxxxx'. substr($values['creditCardNumber'], -4),
                'booking_id'=>$confirmationNumber,
                'booking_hotelName'=>'',
                'booking_hotelContact'=>'',
                'booking_ckeckIn'=>$values['checkIn'],
                'booking_checkOut'=>$values['checkOut'],
                'booking_rate'=> isset($values['total']) ? $values['total'] : '',
                'booking_roomType' => '',
                'booking_nights' => '',
                'booking_rooms' => isset($values['rooms']) ? $values['rooms'] : 0,
                'booking_adults' => $numAdults,
                'booking_children' => $numChildren
            );

            feflip_features_StoreBooking($args);

            return $confirmationNumber;
            */
        }
    }

    /**
     * Returns all destinations of drupal data base
     * @return array
     */
    static function getDestinations()
    {
        $result = Destination::GetAllDestination();
        return $result;
    }


    /**
     * Create a new user
     * @param $input_values
     * @param $error
     * @return bool
     */
    static function signUpUser($input_values, &$error)
    {
        $mail = $input_values['userEmail'];
        $pass = $input_values['userPassword'];
        $firstName = (isset($input_values['userName']) ? $input_values['userName'] : '');
        $lastName = (isset($input_values['userLast']) ? $input_values['userLast'] : '');

        $user = user_load_by_name($mail);

        if (!$user)
        {
            $new_user = array(
                'name' => $mail,
                'pass' => $pass,
                'mail' => $mail,
                //'signature_format' => 'full_html',
                'status' => 1,
                //'access' => REQUEST_TIME,
                //'timezone' => 'America/New_York',
                //'init' => 'email address',
                //'roles' => array(DRUPAL_AUTHENTICATED_RID => 'authenticated user'),
                'field_first_name' =>
                    array(LANGUAGE_NONE =>
                        array(0 =>
                            array('value' => $firstName))),
                'field_last_name' =>
                    array(LANGUAGE_NONE =>
                        array(0 =>
                            array('value' => $lastName))),
            );

            try
            {
                $account = user_save(NULL, $new_user);

                $result = self::signInUser($input_values, $error);

                $error = '';
                //_user_mail_notify('register_no_approval_required', $account);
                return $result;
            }
            catch (Exception $e)
            {
                $error = $e->getMessage();
                return false;
            }
        }
        else
        {
            $error = 'User already exists';
            return false;
        }
    }

    /**
     * User log in
     * @param $input_values
     * @param $error
     * @return bool
     */
    static function signInUser($input_values, &$error)
    {
        $username = $input_values['userEmail'];
        $password = $input_values['userPassword'];

        if($uid = self::user_authenticate($username, $password))
        {
            try
            {
                $form_state = array('uid' => $uid);
                user_login_submit(array(), $form_state);
                $error = '';
                return true;
            }
            catch (Exception $e)
            {
                $error = $e->getMessage();
                return false;
            }
        }
        else
        {
            $error = 'User not authenticate';
            return false;
        }
    }

    /**
     * User log out
     * @param $error
     * @return bool
     */
    static  function logOutUser(&$error)
    {
        try
        {
            module_load_include('pages.inc', 'user');
            user_logout();
            $error = '';
            return true;
        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
            return false;
        }
    }

    /**
     * Return in user is logged in
     * @return bool
     */
    static function userIsLoggedIn()
    {
        if (user_is_logged_in())
            return 'true';//self::encrypt_decrypt('encrypt','true');
        else
            return 'false';//self::encrypt_decrypt('encrypt','false');
    }

    /**
     * Return destinations and/or hotels that starts with parameter
     * @param $key
     * @return array
     */
    static function CustomSearch($key)
    {
        $payload = array('destinations' => array(), 'hotels' => array());
        if (!empty($key)){
            $efq = new EntityFieldQuery();
            $result = $efq->entityCondition('entity_type', 'node')
                ->entityCondition('bundle', array('destination', 'hotel'), 'IN')
                ->propertyCondition('title', $key, 'CONTAINS')
                ->execute();
            if (isset($result['node']) && !empty($result['node'])){
                foreach ($result['node'] as $key => $res) {
                    $node = node_load($res->nid);
                    $image = Helpers::GetMainImageFromFieldCollection($node->field_images, $node->title,'http://placehold.it/100x100', 'itinerary_main_icon');
                    switch ($node->type) {
                        case 'destination':
                            $payload['destinations'][] = array('title' => $node->title, 'image' => $image['url'], 'url' => '/'.drupal_get_path_alias('node/'.$node->nid.'/itinerary'));
                            break;
                        case 'hotel':
                            $payload['hotels'][] = array('title' => $node->title, 'image' => $image['url'], 'url' => '/'.drupal_get_path_alias('node/'.$node->nid));
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        return $payload;
    }
}

?>