<?php

class Sabre
{
     
     var $IPCC = '';
     var $USERNAME = '';
     var $PASSWORD = '';
     var $TESTMODE;
     var $TESTSUFFIX = '';

    /**
     *Constructor
     */
    function Sabre()
     {
        $this->IPCC = variable_get('sabre_ipcc');
        $this->USERNAME = variable_get('sabre_username');
        $this->PASSWORD = variable_get('sabre_passw');
        $this->TESTMODE = variable_get('sabre_test_mode');
        
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
            $xmlstr = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlstr ));
            $xml = simplexml_load_string($xmlstr); 
            $securityToken = (string)$xml->children('soap-env',true)->Header->children('wsse',true)->Security->BinarySecurityToken;
            $result = array(
                            'SecurityToken' => (string)$xml->children('soap-env',true)->Header->children('wsse',true)->Security->BinarySecurityToken,
                            'ConversationId'    => $response->ConversationId
                            );
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            $result = array();
        }        
        
        return $result;
     }


    /**
     * Close a open session
     * @param $securityToken
     * @param $conversationId
     * @return string
     */
    public function CloseSession($securityToken, $conversationId)
     {
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
            
            $xmlRequest = $service->endpoint()->client()->__getLastRequest();
            dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
            
            dpm($response);
        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            dpm($response);
        }   
        finally
        {
            //Close sabre session
            $this->CloseSession($securityToken, $conversationId);
        }
     }


    public function ListHotelAvail($hotelsCodes, $numpersonas, $start, $end)
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
            $this->CloseSession($securityToken, $conversationId);
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
    public function HotelDescription($hotelCode, $numpersonas, $start, $end)
     {
        //Open session with sabre
        $sessionInfo = $this->CreateSession();
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
            $args['AvailRequestSegment']['RateRange']['CurrencyCode'] = 'USD';
            $args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['HotelRef']['HotelCode'] = $hotelCode;
            $args['AvailRequestSegment']['TimeSpan']['End'] = $end;
            $args['AvailRequestSegment']['TimeSpan']['Start'] = $start;
            $args['Version'] = '2.1.0';
                        
            $response = $service->HotelPropertyDescriptionRQ($args);
            
            //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
            //dpm($this->ReadXML($xmlRequest));
            $xmlResponse = $service->endpoint()->client()->__getLastResponse();
            dpm($this->ReadXML($xmlResponse));
            
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
            $this->CloseSession($securityToken, $conversationId);
        }
        
        return $response;
     }

    /**
     * Returns array hotels description
     * @param $hotelsCodes
     * @param $numpersonas
     * @param $start
     * @param $end
     * @return array
     */
    public function ListHotelDescription($hotelsCodes, $numpersonas, $start, $end)
    {
        //Open session with sabre
        $sessionInfo = $this->CreateSession();
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

        $response = array();

        //Execute operation
        try
        {
            foreach($hotelsCodes as $code) {
                $args['AvailRequestSegment']['GuestCounts']['Count'] = $numpersonas;
                $args['AvailRequestSegment']['RateRange']['CurrencyCode'] = 'USD';
                $args['AvailRequestSegment']['HotelSearchCriteria']['Criterion']['HotelRef']['HotelCode'] = $code;
                $args['AvailRequestSegment']['TimeSpan']['End'] = $end;
                $args['AvailRequestSegment']['TimeSpan']['Start'] = $start;
                $args['Version'] = '2.1.0';

                $response[$code] = $service->HotelPropertyDescriptionRQ($args);

                //$xmlRequest = $service->endpoint()->client()->__getLastRequest();
                //dpm($this->ReadXML($xmlRequest));
                //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
                //dpm($this->ReadXML($xmlResponse));

                //dpm($response);
            }
        }
        catch (Exception $e)
        {
            $response[] = $e->getMessage();
            //dpm($response);
        }
        finally
        {
            //Close sabre session
            $this->CloseSession($securityToken, $conversationId);
        }

        return $response;
    }

     
     public function HotelBookReservation($roomTypes, $hotelCode, $numPersonas, $star, $end)
     {
        //Open session with sabre
        $sessionInfo = $this->CreateSession();
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
        
        //Execute operation
        try
        {            
            $args = array();
            $args['Hotel']['BasicPropertyInfo']['HotelCode'] = $hotelCode;
            $args['Hotel']['BasicPropertyInfo']['ConfirmationNumber'] = 'ABC123';
    
            $args['Hotel']['Guarantee']['Type'] = 'GDPST';
            $args['Hotel']['Guarantee']['CC_Info']['PaymentCard']['Code'] = 'AX';
            $args['Hotel']['Guarantee']['CC_Info']['PaymentCard']['ExpireDate'] = '2015-12';
            $args['Hotel']['Guarantee']['CC_Info']['PaymentCard']['Number'] = '1234567890';
            $args['Hotel']['Guarantee']['CC_Info']['PersonName']['Surname'] = 'TEST';
            
            $args['Hotel']['RoomType']['NumberOfUnits'] = $roomTypes[0]['numunit'];
            $args['Hotel']['RoomType']['RoomTypeCode'] = $roomTypes[0]['code'];
            $args['Hotel']['GuestCounts']['Count'] = $numPersonas;
            $args['Hotel']['TimeSpan']['Start'] = $star;
            $args['Hotel']['TimeSpan']['End'] = $end;
            $args['Version'] = '2.1.0';
            
            $response = $service->OTA_HotelResRQ($args);
            
            $xmlRequest = $service->endpoint()->client()->__getLastRequest();
            dpm($this->ReadXML($xmlRequest));
            //$xmlResponse = $service->endpoint()->client()->__getLastResponse();
            //dpm($this->ReadXML($xmlResponse));
            
            dpm($response);

        }
        catch (Exception $e)
        {
            $response = $e->getMessage();
            //dpm($response);
        }           
        finally
        {
            //Close sabre session
            $this->CloseSession($securityToken, $conversationId);
        }        
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
            $this->CloseSession($securityToken, $conversationId);
        }        
     }
     
     public function TravelItineraryAddInfo($sessionInfo, $name, $surname)
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
                  
            /*
            $args['AgencyInfo']['Address']['AddressLine'] = 'SABRE TRAVEL';
            $args['AgencyInfo']['Address']['CityName'] = 'SOUTHLAKE';
            $args['AgencyInfo']['Address']['CountryCode'] = 'US';
            $args['AgencyInfo']['Address']['PostalCode'] = '76092';
            $args['AgencyInfo']['Address']['StateCountyProv']['StateCode'] = 'TX';
            $args['AgencyInfo']['Address']['StreetNmbr'] = '3150 SABRE DRIVE';
            */
            $args['CustomerInfo']['PersonName']['GivenName'] = $name;
            $args['CustomerInfo']['PersonName']['Surname'] = $surname;
            //$args['CustomerInfo']['PersonName']['GivenName'] = 'otro';
            //$args['CustomerInfo']['PersonName']['Surname'] = 'este es el otro';
            
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
            //var_dump ($e);
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
            
            $xmlRequest = $service->endpoint()->client()->__getLastRequest();
            dpm($this->ReadXML($xmlRequest));
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
}