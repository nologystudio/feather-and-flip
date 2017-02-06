<?php

class AdminForms
{
    const API = 'Mailchimp.php';
    const APIKEY = 'f5750086c993fade5293935c6877ccf1-us8';//'eae1d5448b1a2cb751661162fd5011fd-us8';
    const LISTID = '9539518750';//'487e37ac3f';

    const API_ID = '82c1af9c7a362d1715d64219a53ed5cc';
    const API_KEY = 'fa95f96b3d44754f3beb4e';
    const ROBLY_LIST = '186769';
    const ROBLY_URL = 'https://api.robly.com/api/v1/sign_up/generate';


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
                else {
                    // Check if the user is an imported user
                    if (isset($account->field_bv_password) && !empty($account->field_bv_password['und'][0]['value'])) {
                        // Double check user, check rails encryption
                        $acpass = $account->field_bv_password['und'][0]['value'];
                        $salt = substr($acpass, 0, 29);
                        $is_bvuser =  crypt($password, $salt) == $acpass ? true : false;
                        if ($is_bvuser){
                            $account->field_password_rehashed['und'][0]['value'] = 1;
                            user_save($account, array('pass' => $password));
                            watchdog('BV user control', 'Rehashed password for '. $name);
                            $uid = $account->uid;
                        }
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
        if (!isset($custom_data['userEmail']))
        {
            $errorMsg = "You must include an email.";
            return false;
        }

        require_once(self::API);

        try
        {
            $url = self::ROBLY_URL.'?api_id='.self::API_ID.'&api_key='.self::API_KEY.'&email='.$custom_data['userEmail'].'&sub_lists[]='.self::ROBLY_LIST.'&welcome_email=true';
            // Add first name if exists
            if (isset($custom_data['userName']))
                $url .= '&fname='.$custom_data['userName'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($response, true);

            if ($json['successful']) {
                return true;
            } else {
                $errorMsg .= 'Error: '.$json['message'];
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
        foreach ($values['rooms']['info'] as $room)
            $numAdults += $room['adults'];

        $sabreEnable = variable_get('sabre_enable');

        $sabre = array();
        $expedia = array();

        if ($sabreEnable == 1)
        {
            $rateCodes = Hotel::GetHotelRateCodesBydestination($values['destination']);
            $sabre = $sabreService->ListHotelAvail($values['sabreCodes'],$rateCodes, $numAdults, $sabreChecking, $sabreCheckout);
        }

        $expedia = Expedia::GetHotelsByCode_XML($values['eanCodes'], $values['checkIn'], $values['checkOut'], $values['rooms']['info']);

        return array(
            'sabre' => $sabre,
            'expedia' => $expedia
        );
    }

    /**
     * Returns hotels rates of expedia and sabre (call webservice) from hotels collections
     * @param $values
     * @return array
     */
    static function getCollectionRates($values)
    {
        $sabreService = new Sabre;
        $sabreEnable = variable_get('sabre_enable');

        $sabre = array();
        $expedia = array();

        if (isset($values['hotelsId']))
        {
            $sabreCodes = array();
            $eanCodes = array();
            $rateCodes = array();

            foreach($values['hotelsId'] as $hotelId)
            {
                $hotel = node_load($hotelId);
                $wrapper = entity_metadata_wrapper('node', $hotel);

                $sabreCode = $wrapper->field_hotelcode->value();
                $eanCode = $wrapper->field_ean_hotelcode->value();
                $rateCode = $wrapper->field_rate_code->value();

                if (isset($sabreCode) && !empty($sabreCode) && $sabreCode != '0000000') $sabreCodes[] = trim($sabreCode);
                if (isset($eanCode) && !empty($eanCode) && $eanCode != '0000000') $eanCodes[] = trim($eanCode);
                if (isset($rateCode) && !empty($rateCode)) $rateCodes[] = $rateCode;
            }

            $date = explode("/", $values['checkIn']);
            $sabreChecking = $date[2].'-'. $date[0].'-'.$date[1];
            $date = explode("/", $values['checkOut']);
            $sabreCheckout = $date[2].'-'. $date[0].'-'.$date[1];

            // Sabre numAdults
            $numAdults = 0;
            foreach ($values['rooms']['info'] as $room)
                $numAdults += $room['adults'];

            if ($sabreEnable == 1)
            {
                $sabre = $sabreService->ListHotelAvail($sabreCodes, $rateCodes, $numAdults, $sabreChecking, $sabreCheckout);
            }

            $expedia = Expedia::GetHotelsByCode_XML($eanCodes, $values['checkIn'], $values['checkOut'], $values['rooms']['info']);

        }

        return array(
            'sabre' => $sabre,
            'expedia' => $expedia
        );
    }

    /**
     * Cancel an existing booking
     * @param $values
     * @param $error
     *
     * @return array
     */
    static function hotelCancelBooking($values, &$error)
    {
        if (!isset($values['service']) || !isset($values['itineraryId']) || !isset($values['confirmationNumber']) || !isset($values['userEmail'])){
            $error = 'Missing parameters';
            return '';
        }
        else {
            if ($values['service'] == 'sabre') {
                $error = 'Method not implemented (Sabre)';
                return '';
            }
            elseif ($values['service'] == 'expedia') {
                $rs = Expedia::CancelBooking_XML($values['itineraryId'], $values['confirmationNumber'], $values['userEmail']);
                if (isset($rs['HotelRoomCancellationResponse']) && isset($rs['HotelRoomCancellationResponse']['cancellationNumber'])) {
                    $query = new EntityFieldQuery;
                    $booking = $query->entityCondition('entity_type', 'entityform')
                        ->entityCondition('type', 'booking')
                        ->fieldCondition('field_booking_id','value', $values['itineraryId'], '=')
                        ->fieldCondition('field_confirmation_number','value', $values['confirmationNumber'], '=')
                        ->execute();

                    if (isset($booking['entityform']))
                    {
                        $resultquery = $booking['entityform'];
                        $keys = array_keys($resultquery);
                        foreach ($keys as $key) {
                            $eform = entity_load_single('entityform', $key);
                            $wform = entity_metadata_wrapper('entityform', $eform);
                            $wform->field_cancellation_number = $rs['HotelRoomCancellationResponse']['cancellationNumber'];
                            $wform->save();
                            break;
                        }
                        $error = '';
                        return 'Booking cancelled';
                    }
                }
                else {
                    if (isset($rs['HotelRoomCancellationResponse']) && isset($rs['HotelRoomCancellationResponse']['EanWsError']))
                        $error = $rs['HotelRoomCancellationResponse']['EanWsError']['presentationMessage'];
                    else
                        $error = 'Something went wrong';

                    // ********************************************************************************************************
                    // TEST PURPOSES - save a fake cancellation number if is an error testing in expedia
                    if (strpos($error, 'OMS OrderNumber not found for emain itinerary number') !== false) {
                        $query = new EntityFieldQuery;
                        $booking = $query->entityCondition('entity_type', 'entityform')
                            ->entityCondition('bundle', 'booking')
                            ->fieldCondition('field_booking_id','value', $values['itineraryId'], '=')
                            ->fieldCondition('field_confirmation_number','value', $values['confirmationNumber'], '=')
                            ->execute();

                        if (isset($booking['entityform']))
                        {
                            $resultquery = $booking['entityform'];
                            $keys = array_keys($resultquery);
                            foreach ($keys as $key) {
                                $eform = entity_load_single('entityform', $key);
                                $wform = entity_metadata_wrapper('entityform', $eform);
                                $wform->field_cancellation_number = 'XX-1234-XX';
                                $wform->save();
                                break;
                            }
                            $error = '';
                            return 'TEST - Booking cancelled';
                        }
                    }
                    // ***********************************************************************************************************  END TESTS

                    return '';
                }
            }
            else {
                $error = 'Booking service not passed';
                return '';
            }
        }
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
        foreach ($values['rooms']['info'] as $room)
            $numAdults += $room['adults'];

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
                        unset($_SESSION['sabreSession']);
                    }catch(Exception $e){}
                }

                $sessionInfo = $sabreService->CreateSession();
                $_SESSION['sabreSession'] = $sessionInfo;

                $rateCodes = $values['rateCodes'];

                return $sabreService->HotelDescription($sessionInfo, $hotelId, $rateCodes, $numAdults, $sabreChecking, $sabreCheckout);
            }

            else
                return Expedia::RoomAvailability_XML($hotelId, $values['checkIn'], $values['checkOut'], $values['rooms']['info']);
        }

    }

    static function hotelBookingReservation($values)
    {
        $sabreService = new Sabre;

        $service = isset($values['service']) ? $values['service'] : null;

        $numAdults = 0;
        $numChildren = 0;

        foreach ($values['rooms']['info'] as $room) {
            $numAdults += $room['adults'];
            $numChildren += $room['children']['number'];
        }

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        if (Helpers::get_device_type() != 'desktop')
            $userAgent .= '; MOBILE_SITE';

        $args = array();
        if (isset($service) && $service == 'sabre')
        {
            $sessionInfo = $_SESSION['sabreSession'];

            $result = $sabreService->HotelBookReservation($sessionInfo,$values['roomCode'], $values['numUnit'], $values['firstName'], $values['lastName'], $values['email'], $values['phone'],
                $values['guaranteeType'], $values['creditCardCode'], $values['creditCardExpireDate'], $values['creditCardNumber']);

            //watchdog('HotelBookingReservation', 'AdmiForm.class ===> '. '<pre>' . print_r( $result, true) . '</pre>');

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
                    'booking_rate'=>$values['chargeableRate'] . ' ' . $result->Hotel->RoomRates->RoomRate->Rates->Rate->CurrencyCode,
                    'booking_roomType' => '',
                    'booking_nights' => $result->Hotel->TimeSpan->Duration,
                    'booking_rooms' => $result->Hotel->NumberOfUnits,
                    'booking_adults' => $numAdults,
                    'booking_children' => $numChildren,
                    'booking_service' => $service,
                    'user_address1' => $values['address'],
                    'user_citycode'=> $values['cityCode'],
                    'user_stateProvinceCode'=> $values['provinceCode'],
                    'user_countryCode'=> $values['countryCode'],
                    'user_postalCode'=> $values['postalCode'],
                    'booking_tax_rate' => $values['taxRate'].' ' . $result->Hotel->RoomRates->RoomRate->Rates->Rate->CurrencyCode,
                    'booking_policy_cancel' =>  isset($values['cancellationPolicy']) ? $values['cancellationPolicy'] : ''
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
                $values['creditCardCode'], $values['creditCardNumber'], $values['creditCardIdentifier'], $creditCardExpirationMonth, $creditCardExpirationYear, $values['address'], $values['cityCode'], $values['postalCode'] );

            watchdog('HotelBookingReservation', 'Response Booking ===> '. '<pre>' . print_r( $result, true) . '</pre>');

            if(isset($result['HotelRoomReservationResponse']) && isset($result['HotelRoomReservationResponse']['processedWithConfirmation']) && isset($result['HotelRoomReservationResponse']['reservationStatusCode']) && $result['HotelRoomReservationResponse']['reservationStatusCode'] == 'CF')
            {
                $nights = '';
                if (isset($values['nightlyRates']))
                {
                    if (!isset($values['nightlyRates']['@rate']))
                    {
                        foreach ($values['nightlyRates'] as $rate)
                            $nights .= $rate['@rate'] . ' ' . $result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode'] . '|';
                    }
                    else
                    {
                        $nights = $values['nightlyRates']['@rate'] . ' ' . $result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode'] . '|';
                    }

                    $nights = substr($nights,0, strlen($nights)-1);
                }

                $args = array(
                    'user_first_name'=>$values['firstName'],
                    'user_last_name'=>$values['lastName'],
                    'user_email'=>$values['email'],
                    'user_phoneNumber' =>$values['phone'],
                    'user_creditCard' => 'xxxxxxxxxxxx'. substr($values['creditCardNumber'], -4),
                    'booking_id'=>$result['HotelRoomReservationResponse']['itineraryId'],
                    'booking_confirmation_number' =>  is_array($result['HotelRoomReservationResponse']['confirmationNumbers']) ? $result['HotelRoomReservationResponse']['confirmationNumbers'][0] : $result['HotelRoomReservationResponse']['confirmationNumbers'],
                    'booking_hotelName'=>$result['HotelRoomReservationResponse']['hotelName'],
                    'booking_hotelContact'=> isset($values['hotelPhone']) ? $values['hotelPhone'] : '',
                    'hotel_address' => isset($values['hotelAddress']) ? $values['hotelAddress'] : '',
                    'booking_ckeckIn'=>$values['checkIn'],
                    'booking_checkOut'=>$values['checkOut'],
                    'booking_rate'=> $result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@total'] . ' ' . $result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode'],
                    'booking_nights' => $nights,//$result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['NightlyRatesPerRoom']['@size'],
                    'booking_roomType' => $result['HotelRoomReservationResponse']['roomDescription'],
                    'booking_rooms' => $result['HotelRoomReservationResponse']['numberOfRoomsBooked'],
                    'booking_adults' => $numAdults,//$result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['RoomGroup']['Room']['numberOfAdults'],
                    'booking_children' => $numChildren,//$result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['RoomGroup']['Room']['numberOfChildren'],
                    'booking_service' => $service,
                    'user_address1' => $values['address'],
                    'user_citycode'=> $values['cityCode'],
                    'user_stateProvinceCode'=> $values['provinceCode'],
                    'user_countryCode'=> $values['countryCode'],
                    'user_postalCode'=> $values['postalCode'],
                    'booking_tax_rate' => $values['taxRate']. ' ' . $result['HotelRoomReservationResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode'],
                    'booking_policy_cancel' => $values['cancellationPolicy'],
                    'user_ip' => $_SERVER['REMOTE_ADDR'],
                    'user_agent' => $userAgent
                );
            }

            //watchdog('HotelBookingReservation', 'Expedia.class  Args  ===> '. '<pre>' . print_r( $args, true) . '</pre>');

            return array('result' => $result, 'args' => $args);
        }
    }

    /**
     * Return hotel patment types
     * @param $values
     * @return null|string
     */
    static function getPaymentTypes($values)
    {
        return Expedia::PaymentTypes_XML($values['hotelId'], $values['supplierType'], $values['rateType']);
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
                _user_mail_notify('register_no_approval_required', $account);

                $result = self::signInUser($input_values, $error);

                $error = '';
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
            return 'true';
        else
            return 'false';
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
                ->propertyCondition('status', 1)
                ->propertyCondition('title', $key, 'STARTS_WITH')
                ->propertyOrderBy('title', 'ASC')
                ->execute();
            if (isset($result['node']) && !empty($result['node'])){
                foreach ($result['node'] as $key => $res) {
                    $node = node_load($res->nid);
                    $image = Helpers::GetMainImageFromFieldCollection($node->field_images, $node->title,'http://placehold.it/100x100', 'itinerary_main_icon');
                    switch ($node->type) {
                        case 'destination':
                            $payload['destinations'][] = array(
                                'title' => $node->title,
                                'image' => $image['url'],
                                'url' => '/'.drupal_get_path_alias('node/'.$node->nid.'/hotel-reviews'),
                                'guide_url' => '/'.drupal_get_path_alias('node/'.$node->nid.'/city-guide'),
                            );
                            break;
                        case 'hotel':
                            $payload['hotels'][] = array(
                                'title' => $node->title,
                                'image' => $image['url'],
                                'url' => '/'.drupal_get_path_alias('node/'.$node->nid),
                                'guide_url' => '/'.drupal_get_path_alias('node/'.$node->field_destination['und'][0]['target_id'].'/city-guide').'?hotel='.$node->nid,
                                'hotel_id' => $node->nid,
                            );
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        return $payload;
    }

    /**
     * Submit entity form contact in drupal
     * @param $inputValues
     */
    static function ContactSubmit($inputValues)
    {
        global $user;
        $entityform = entity_create('entityform', array(
            'type' => 'contact',
            'created' => time(),
            'changed' => time(),
            'language' => LANGUAGE_NONE,
            'uid' => $user->uid));

        $wrapper = entity_metadata_wrapper('entityform', $entityform);

        //Fill fields
        $wrapper->field_contact_first_name            = $inputValues['firstName'];
        //$wrapper->field_contact_last_name             = $inputValues['lastName'];
        $wrapper->field_contact_email                 = $inputValues['email'];
        //$wrapper->field_contact_department            = $inputValues['department'];
        //$wrapper->field_contact_subject               = $inputValues['subject'];
        $wrapper->field_contact_message               = $inputValues['message'];

        //Done!
        $wrapper->save();
    }

    /**
     * Send reset password mail
     * @param $userEmail
     * @param $error
     *
     * @return $result
     */
    static function ResetPassw($userEmail, &$error)
    {
        $account = user_load_by_name($userEmail);
        if ($account && !empty($userEmail)) {
            // Mail one time login URL and instructions using current language.
            $mail = _user_mail_notify('password_reset', $account, language_default());
            if (!empty($mail)) {
                watchdog('user', 'Password reset instructions mailed to %name at %email.', array('%name' => $account->name, '%email' => $account->mail));
                $error = '';
                return 'Mail sent';
            }
            else {
                $error = 'Error sending email';
                return '';
            }
        }
        else {
            $error = 'User not found';
            return '';
        }
    }

    /**
     * Update current user password
     * @param $newPass
     * @param $error
     *
     * @return $result
     */
    static function UpdatePassw($newPass, &$error)
    {
        global $user;
        require_once DRUPAL_ROOT . '/' . variable_get('password_inc', 'includes/password.inc');
        if (user_is_logged_in()) {
            $hashthepass = user_hash_password(trim($newPass));

            // Abort if the hashing failed and returned FALSE.
            if (!$hashthepass || empty($newPass)) {
                $error = 'Password hash has failed';
                return '';
            }else{
                db_update('users')
                    ->fields(array(
                        'pass' => $hashthepass))
                    ->condition('uid', $user->uid)       
                    ->execute();
                $error = '';
                return 'Password setted';
            }
        }
        else {
            $error = 'You are not authorized to access this page';
            return '';
        }
    }

    /**
     * Return address book of hotel
     * @param $hotelId
     * @return array
     */
    static function AddressBookByDestination($destinationId)
    {
        $addressbooks = array();

        if (!isset($destinationId) || empty(trim($destinationId))) return $addressbooks;

        $addressbooks = Hotel::GetAddressBook($destinationId);

        return $addressbooks;
    }

    /**
     * Submit entity form contact in drupal
     * @param $inputValues
     */
    static function PassBookSubmit($inputValues)
    {
        global $user;
        $entityform = entity_create('entityform', array(
            'type' => 'book_hotel',
            'created' => time(),
            'changed' => time(),
            'language' => LANGUAGE_NONE,
            'uid' => $user->uid));

        $wrapper = entity_metadata_wrapper('entityform', $entityform);

        //Fill fields
        $wrapper->field_contact_email       = $inputValues['email'];
        $wrapper->field_start_date          = $inputValues['start_date'];
        $wrapper->field_end_date            = $inputValues['end_date'];
        $wrapper->field_adults              = $inputValues['adults'];
        $wrapper->field_children            = $inputValues['children'];
        $wrapper->field_budget_ratio        = $inputValues['budget'];
        $wrapper->field_contact_message     = $inputValues['message'];
        $wrapper->field_form_destination    = $inputValues['destination'];
        $wrapper->field_form_hotel          = $inputValues['hotel'];
        $wrapper->field_first_name          = $inputValues['name'];
        $wrapper->field_last_name           = $inputValues['last'];
        $wrapper->field_specific_budget     = $inputValues['specific_budget'];

        //Done!
        $wrapper->save();
    }
}

?>