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

    // Get hotel rates
    static function getHotelRates($values)
    {
        //$sabreService = new Sabre;
        $expediaService = new Expedia;
        
        /*
        $date = explode("/", $values['checkin']);
        $sabreChecking = $date[2].'-'. $date[0].'-'.$date[1];
        $date = explode("/", $values['checkout']);
        $sabreCheckout = $date[2].'-'. $date[0].'-'.$date[1];
        */
        
        return array(
            //'sabre' => $sabreService->HotelDescription($values['hotelCode'], $values['numAdults'], $sabreChecking, $sabreCheckout),
            'expedia' => $expediaService->RoomAvailability($values['eanCode'], $values['checkin'], $values['checkout'], $values['numRooms'], $values['numAdults'], $values['numChildren'])
        );
        
    }
    
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
        $mail = $input_values['mail'];
        $pass = $input_values['password'];
        $firstName = $input_values['firstname'];
        $lastName = $input_values['lastname'];

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
                user_save(NULL, $new_user);
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
        $username = $input_values['username'];
        $password = $input_values['password'];

        if($uid = user_authenticate($username, $password))
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
}

?>