<?php

class Sabre
{
     
     var $IPCC = 'O58H';
     var $CONTEXT = 'X840';
     var $USERNAME = '7971';
     var $PASSWORD = 'WS072514';
     var $TESTMODE = 1;
     var $TESTSUFFIX = '';

    /**
     *Constructor
     */
    function Sabre()
     {
        $this->IPCC = variable_get('sabre_ipcc', $this->IPCC);
        $this->USERNAME = variable_get('sabre_username', $this->USERNAME);
        $this->PASSWORD = variable_get('sabre_passw', $this->PASSWORD);
        $this->TESTMODE = variable_get('sabre_test_mode', $this->TESTMODE);

        if ($this->TESTMODE == 1)
            $this->TESTSUFFIX = "_test";
        else
            $this->TESTSUFFIX = '';        
     }

    /**
     * Create message header for soap message
     * @param $action
     * @param $conversationID
     * @return SoapHeader
     */
    private function Header_MessageHeader($action, $conversationID)
     {
        $toDate = new DateTime();
        $timestamp = $toDate->format('Y-m-d\Th:i:sP');
        $timetolive = $toDate->add(new DateInterval('PT1H'))->format('Y-m-d\Th:i:sP');
        $messageID = uniqid();
        
        $messageHeader = array(
                  'From'    => array('PartyId' => ''),
                  'To'      => array('PartyId' => ''),
                  'CPAId'   => $this->IPCC,
                  'ConversationId' => $conversationID,
                  'Service'        => array(
                                        '_' => $action,
                                        'type' => 'sabreXML',
                                            ),
                  'type'    => 'sabreXml',
                  'Action'  => $action, 
                  'MessageData' => array(
                                    'MessageId'       => $messageID,
                                    'Timestamp'       => $timestamp ,
                                    'TimeToLive'      => $timetolive
                                         )
                                       
                        );
        
        $header = new SoapHeader('http://www.ebxml.org/namespaces/messageHeader','MessageHeader', $messageHeader); 
        
        return $header;
     }

    /**
     * Create security header with user name token
     * @return SoapHeader
     */
    private function Header_UserNameToken()
     {
        $usernameToken = array(
                    'UsernameToken' => array(
                                        'Username'      => $this->USERNAME,
                                        'Password'      => $this->PASSWORD,
                                        'Organization'  => $this->IPCC,
                                        'Domain'        => 'DEFAULT'
                                            )
                          );
        
        $header = new SoapHeader('http://schemas.xmlsoap.org/ws/2002/12/secext','Security',$usernameToken);
        
        return $header;
     }

    /**
     * Create security header with security token
     * @param $securityToken
     * @return SoapHeader
     */
    private function Header_SecurityToken($securityToken)
     {
           $securityTokenHeader = array( 
                          'BinarySecurityToken' => $securityToken
                               );
           
           $header = new SoapHeader('http://schemas.xmlsoap.org/ws/2002/12/secext','Security',$securityTokenHeader);
           
           return $header;
     }

    /**
     * Create a session with sabre service and get security token and conversation id
     * @return array
     */
    public function CreateSession()
     {
        
        $service = wsclient_service_load('createsession'.$this->TESTSUFFIX);
        
        $headers = array(
            $this->Header_MessageHeader('SessionCreateRQ', uniqid()),
            $this->Header_UserNameToken()
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;
        $service->settings['soap_headers'] = $headers;
        
        try
        {  
            $response = $service->SessionCreateRQ($this->IPCC);

            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));

            $xmlstr = $service->endpoint()->client()->__getLastResponse();
            $xml = simplexml_load_string($xmlstr);
            $result = array(
                            'SecurityToken' => (string)$xml->children('soap-env',true)->Header->children('wsse',true)->Security->BinarySecurityToken,
                            'ConversationId'    => $response->ConversationId
                            );

            //Hacemos una cambio de contexto para poder usar los rate codes de F+F que se encuentran en X840
            /*
            $newSecurityToken = $this->ChangeContext($result);

            if (isset($newSecurityToken) && !empty($newSecurityToken))
            {
                if ($newSecurityToken != $result['SecurityToken'])
                    $result['SecurityToken'] = $newSecurityToken;
            }
            */

        }
        catch (Exception $e)
        {
            $result = array();
            $result['error'] = $e->getMessage();
        }        
        
        return $result;
     }


    /**
     * Close a open session
     * @param $sessionInfo
     * @return string
     */
    public function CloseSession($sessionInfo)
     {
         $securityToken = $sessionInfo['SecurityToken'];
         $conversationId = $sessionInfo['ConversationId'];

         $service = wsclient_service_load('closesession'.$this->TESTSUFFIX);
        
        $headers = array(
            $this->Header_MessageHeader('SessionCloseRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;
        
        try
        {  
            $response = $service->SessionCloseRQ($this->IPCC);
            
            //$xmlstr = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlstr ));
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }
        
        return $response;
     }


    /**
     * Format XML for print
     * @param $xml
     * @return string
     */
     private function ReadXML($xml)
     {
        $dom = new DOMDocument;
        $dom->preserveWhiteSpace = FALSE;
        $dom->loadXML($xml);
        $dom->formatOutput = TRUE;
        return $dom->saveXml();
     }


    /**
     * Call sabre action OTA_HotelAvailLLSRQ and return response
     * @param $hotelCityCode
     * @param $cityName
     * @param $numpersonas
     * @param $start
     * @param $end
     * @return string
     */
    public function HotelAvail($hotelCityCode, $cityName, $numpersonas, $start, $end)
     {
        //Open session with sabre
        $sessionInfo = $this->CreateSession();
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];

        //Load service
        $service = wsclient_service_load('hotelavail'.$this->TESTSUFFIX);
        
        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('OTA_HotelAvailLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;
        
        //Execute operation
        try
        {  
            $args['AvailRequestSegment']['GuestCounts']['Count'] = $numpersonas;
            if(!empty($cityName))
                $args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['Address']['CityName'] = $cityName;
            $args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['HotelRef']['HotelCityCode'] = $hotelCityCode;
            //$args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['HotelRef']['HotelCode'] = $hotelCode;
            //$args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['HotelRef']['HotelName'] = 'Park Hyatt New York';
            $args['AvailRequestSegment']['TimeSpan']['End'] = $end;
            $args['AvailRequestSegment']['TimeSpan']['Start'] = $start;
            $args['Version'] = '2.1.0';
            
            $response = $service->OTA_HotelAvailRQ($args);
            
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            dpm($response);
        }   
        finally
        {
            //Close sabre session
            $this->CloseSession($sessionInfo);
        }

         return $response;
     }


    /**
     * @param $hotelsCodes
     * @param $numpersonas
     * @param $start
     * @param $end
     * @return string
     */
    public function ListHotelAvail($hotelsCodes, $rateCodes, $numpersonas, $start, $end)
    {
        //Open session with sabre
        $sessionInfo = $this->CreateSession();
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];

        //Load service
        $service = wsclient_service_load('hotelavail'.$this->TESTSUFFIX);

        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('OTA_HotelAvailLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
        );

        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;
        $service->settings['soap_headers'] = $headers;

        //Execute operation
        try
        {
            $args['AvailRequestSegment']['GuestCounts']['Count'] = $numpersonas;

            foreach($hotelsCodes as $hotelCode) {
                if ($hotelCode == '0000000')continue;
                $args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['HotelRef'][]['HotelCode'] = $hotelCode;
            }

            if (isset($rateCodes) && count($rateCodes) > 0) {
                foreach ($rateCodes as $rate)
                    $args['AvailRequestSegment']['RatePlanCandidates']['ContractNegotiatedRateCode'][] = $rate;
            }

            $args['AvailRequestSegment']['TimeSpan']['End'] = $end;
            $args['AvailRequestSegment']['TimeSpan']['Start'] = $start;
            $args['Version'] = '2.1.0';

            $response = $service->OTA_HotelAvailRQ($args);

            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));

            //dpm($response);
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }
        finally
        {
            //Close sabre session
            $this->CloseSession($sessionInfo);
        }

        return $response;
    }


    /**
     * Call sabre action HotelPropertyDescriptionLLSRQ and return response
     * @param $hotelCode
     * @param $numpersonas
     * @param $start
     * @param $end
     * @return string
     */
    public function HotelDescription($sessionInfo,$hotelCode, $numpersonas, $start, $end)
     {
        //Open session with sabre
        //$sessionInfo = $this->CreateSession();
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];
        
        //Load service
        $service = wsclient_service_load('hoteldescription'.$this->TESTSUFFIX);
        
        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('HotelPropertyDescriptionLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;
        
        $response = '';
        
        //Execute operation
        try
        {  
            $args['AvailRequestSegment']['GuestCounts']['Count'] = $numpersonas;
            //$args['AvailRequestSegment']['RateRange']['CurrencyCode'] = 'USD';
            $args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['HotelRef']['HotelCode'] = $hotelCode;
            $args['AvailRequestSegment']['TimeSpan']['End'] = $end;
            $args['AvailRequestSegment']['TimeSpan']['Start'] = $start;
            $args['Version'] = '2.1.0';
                        
            $response = $service->HotelPropertyDescriptionRQ($args);
            
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
            
            //dpm($response);
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }           
        finally
        {
            //Close sabre session
            //$this->CloseSession($sessionInfo);
        }
        
        return $response;
     }


     
     public function HotelBookReservation($sessionInfo,$rph, $numUnit, $firstname, $lastname, $email, $phone,
                                          $guaranteeType, $creditCardCode, $creditCardExpireDate, $creditCardNumber)
     {
        //Open session with sabre
        //$sessionInfo = $this->CreateSession();
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];
        
        //Load service
        $service = wsclient_service_load('hotelbookreservation'.$this->TESTSUFFIX);
        
        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('OTA_HotelResLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;

         $response = '';
        //Execute operation
        try
        {
           //Add person info
            $this->TravelItineraryAddInfo($sessionInfo,$firstname, $lastname, $email);

            $args = array();
            $args['Hotel']['BasicPropertyInfo']['RPH'] = $rph;
            //$args['Hotel']['BasicPropertyInfo']['HotelCode'] = $hotelCode;
            //$args['Hotel']['BasicPropertyInfo']['ConfirmationNumber'] = 'ABC123';


            $args['Hotel']['Guarantee']['Type'] = $guaranteeType;//'G';
            $args['Hotel']['Guarantee']['CC_Info']['PaymentCard']['Code'] = $creditCardCode;//'VI';
            $args['Hotel']['Guarantee']['CC_Info']['PaymentCard']['ExpireDate'] = $creditCardExpireDate;//'2015-12';
            $args['Hotel']['Guarantee']['CC_Info']['PaymentCard']['Number'] = $creditCardNumber;//'4111111111111111';
            $args['Hotel']['Guarantee']['CC_Info']['PersonName']['Surname'] = $lastname;//'TEST';


            $args['Hotel']['RoomType']['NumberOfUnits'] = $numUnit;
            //$args['Hotel']['RoomType']['RoomTypeCode'] = $roomTypes[0]['code'];
            //$args['Hotel']['GuestCounts']['Count'] = $numPersonas;
            //$args['Hotel']['TimeSpan']['Start'] = $star;
            //$args['Hotel']['TimeSpan']['End'] = $end;
            $args['Version'] = '2.1.0';

            $response = $service->OTA_HotelResRQ($args);
            
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));

        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }           
        finally
        {
            //Close sabre session
            //$this->CloseSession($sessionInfo);
        }

         return $response;
     }
     
     public function HotelModifyReservation()
     {
        //Open session with sabre
        $sessionInfo = $this->CreateSession();
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];
        
        //Load service
        $service = wsclient_service_load('hotelmodifyreservation'.$this->TESTSUFFIX);
        
        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('HotelResModifyLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;
        
        //Execute operation
        try
        {  
            $args = array();
            $response = $service->HotelResModifyRQ($args);
            
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
            
            //dpm($response);
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }           
        finally
        {
            //Close sabre session
            $this->CloseSession($sessionInfo);
        }        
     }

    public function CancelBooking($sessionInfo)
    {
        //Open session with sabre
        //$sessionInfo = $this->CreateSession();
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];

        //Load service
        $service = wsclient_service_load('cancelbooking'.$this->TESTSUFFIX);

        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('OTA_CancelLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
        );

        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;
        $service->settings['soap_headers'] = $headers;

        $response = '';

        //Execute operation
        try
        {
            $args = array();
            $args['Segment']['Type'] = 'hotel';
            //$args['Segment']['Number'] = $confirmationNumber;
            $args['Version'] = '2.0.0';
            $response = $service->OTA_CancelRQ($args);

            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }
        finally
        {
            //Close sabre session
            //$this->CloseSession($sessionInfo);
        }

        return $response;
    }
     
     public function TravelItineraryAddInfo($sessionInfo, $name, $surname, $email)
     {
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];
        
        //Load service
        $service = wsclient_service_load('travelitineraryaddinfo'.$this->TESTSUFFIX);
        
        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('TravelItineraryAddInfoLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;
        
        try
        {  
            $args = array();

            $args['AgencyInfo']['Address']['AddressLine'] = 'SABRE TRAVEL';
            $args['AgencyInfo']['Address']['CityName'] = 'SOUTHLAKE';
            $args['AgencyInfo']['Address']['CountryCode'] = 'US';
            $args['AgencyInfo']['Address']['PostalCode'] = '76092';
            $args['AgencyInfo']['Address']['StreetNmbr'] = '3150 SABRE DRIVE';


            $args['CustomerInfo']['Email']['Address'] = $email;
            $args['CustomerInfo']['PersonName']['GivenName'] = $name;
            $args['CustomerInfo']['PersonName']['Surname'] = $surname;

            $args['Version'] = '2.0.2';
            
            $response = $service->TravelItineraryAddInfoRQ($args);
            //dpm($response);
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
            
            //dpm($response);
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
        }
        
        return $response;
     }
     
     
     public function TravelItineraryRead($sessionInfo)
     {
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];
        
        //Load service
        $service = wsclient_service_load('travelitineraryread'.$this->TESTSUFFIX);
        
        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('TravelItineraryReadRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;
        
        try
        {
            $args = array();
            $args['MessagingDetails']['Transaction']['Code'] = 'PNR';
            $args['Version'] = '2.2.0';
            $response = $service->TravelItineraryReadRQ($args);
            
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
            
            //dpm($response);
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }
        
        return $response;
     }
     
     
     public function EndTransaction($sessionInfo)
     {
        $securityToken = $sessionInfo['SecurityToken'];
        $conversationId = $sessionInfo['ConversationId'];
        
        //Load service
        $service = wsclient_service_load('endtransaction'.$this->TESTSUFFIX);
        
        //Create headers and settings
        $headers = array(
            $this->Header_MessageHeader('EndTransactionLLSRQ', $conversationId),
            $this->Header_SecurityToken($securityToken)
                         );
        
        $service->settings['options']['trace'] = TRUE;
        $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;        
        $service->settings['soap_headers'] = $headers;
        
        try
        {  
            $args = array();
            $args['EndTransaction']['Ind'] = 'true';
            $args['Itinerary']['Ind'] = 'false';
            $args['Version'] = '2.0.4';
            $response = $service->EndTransactionRQ($args);
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
            
            //dpm($response);
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }
        
        return $response;        
     }

     public function ChangeContext($sessionInfo)
     {
         $securityToken = $sessionInfo['SecurityToken'];
         $conversationId = $sessionInfo['ConversationId'];

         //Load service
         $service = wsclient_service_load('contextchange'.$this->TESTSUFFIX);

         //Create headers and settings
         $headers = array(
             $this->Header_MessageHeader('ContextChangeLLSRQ', $conversationId),
             $this->Header_SecurityToken($securityToken)
         );

         $service->settings['options']['trace'] = TRUE;
         $service->settings['options']['cache_wsdl'] = WSDL_CACHE_NONE;
         $service->settings['soap_headers'] = $headers;

         $newSecurityToken = '';

         try
         {
             $args = array();
             $args['OverSign']['Organization'] = $this->CONTEXT;
             $args['OverSign']['Username'] = $this->USERNAME;
             $args['Version'] = '2.0.3';
             $response = $service->ContextChangeRQ($args);

             if (isset($response->SecurityToken->_) && !empty($response->SecurityToken->_))
                 $newSecurityToken = $response->SecurityToken->_;

             //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
             //dpm($this->ReadXML($xmlRequest));
             //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
             //dpm($this->ReadXML($xmlResponse));
         }
         catch(Exception $e)
         {
             return $response = $e->getMessage();
         }

         return $newSecurityToken;
     }

    /*
    *   Get lowRate from a HotelRates response
    *   for hotelId parameter
    *   @param Sabre object HotelRates response
    *   @param hotelId
    *   
    */
    public static function GetLowRateFromResponse($ratesResponse, $hotelId)
    {
        $rateInfo = array('rate' => 0.0, 'currency' => '');
        if (is_array($ratesResponse))
        {
            foreach ($ratesResponse as $key => $hotel) {
                if (isset($hotel->BasicPropertyInfo) && $hotel->BasicPropertyInfo->HotelCode == $hotelId) {
                    $rateInfo = array(
                        'rate' => (isset($hotel->BasicPropertyInfo->RateRange) ? $hotel->BasicPropertyInfo->RateRange->Min : 0.0),
                        'currency' => (isset($hotel->BasicPropertyInfo->RateRange) ? $hotel->BasicPropertyInfo->RateRange->CurrencyCode : ''));
                    break;
                }
            }
        }
        else
        {
            if (isset($ratesResponse->BasicPropertyInfo) && $ratesResponse->BasicPropertyInfo->HotelCode == $hotelId) {
                $rateInfo = array(
                    'rate' => (isset($ratesResponse->BasicPropertyInfo->RateRange) ? $ratesResponse->BasicPropertyInfo->RateRange->Min : 0.0),
                    'currency' => (isset($ratesResponse->BasicPropertyInfo->RateRange) ? $ratesResponse->BasicPropertyInfo->RateRange->CurrencyCode : ''));
            }
        }
        return $rateInfo;
    }
}