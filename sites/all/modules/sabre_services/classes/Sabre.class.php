<?php

class Sabre
{
     private $IPCC;
     private $USERNAME;
     private $PASSWORD;
     
     function __construct ()
     {
        this->IPCC = variable_get('sabre_ipcc');
        this->USERNAME = variable_get('sabre_username');
        this->PASSEORD = variable_get('sabre_passw');
     }
     
     private function Header_MessageHeader($action, $conversationID)
     {
        $toDate = new DateTime();
        $timestamp = $toDate->format('Y-m-d\Th:i:sP');
        $timetolive = $toDate->add(new DateInterval('PT1H'))->format('Y-m-d\Th:i:sP');
        $messageID = uniqid();
        
        $messageHeader = array(
                  'From'    => array('PartyId' => ''),
                  'To'      => array('PartyId' => ''),
                  'CPAId'   => this->IPCC,
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
     
     private function Header_UserNameToken()
     {
        $usernameToken = array(
                    'UsernameToken' => array(
                                        'Username'      => this->USERNAME,
                                        'Password'      => this->PASSWORD,
                                        'Organization'  => this->IPCC,
                                        'Domain'        => 'DEFAULT'
                                            )
                          );
        
        $header = new SoapHeader('http://schemas.xmlsoap.org/ws/2002/12/secext','Security',$usernameToken);
        
        return $header;
     }
     
     private function Header_SecurityToken($securityToken)
     {
           $securityTokenHeader = array( 
                          'BinarySecurityToken' => $securityToken
                               );
           
           $header = new SoapHeader('http://schemas.xmlsoap.org/ws/2002/12/secext','Security',$securityTokenHeader);
           
           return $header;
     }
     
     
     /*
      * Create a session with sabre service and get security token and cersation id
      */
     private function CreateSession()
     {
        $service = wsclient_service_load('createsession');
        
        $headers = array(
            self::Header_MessageHeader('SessionCreateRQ', uniqid()),
            self::Header_UserNameToken()
                         );
        
        $service->settings['soap_headers'] = $headers;
     }
     
     /*
      * Close a session 
      */
     private function CloseSession($securityToken)
     {
        $service = wsclient_service_load('closesession');
        
        $headers = array(
            self::Header_MessageHeader('SessionCloseRQ ', uniqid()),
            self::Header_SecurityToken($securityToken)
                         );
        
        $service->settings['soap_headers'] = $headers;        
     }
     
     public function HotelAvail()
     {
        $securityToken = CreateSession();
        
        //TODO: Code for to complete function here
        
        CloseSession($securityToken);
     }
     
     public function HotelDescription()
     {
        $securityToken = CreateSession();
        
        //TODO: Code for to complete function here
        
        CloseSession($securityToken); 
     }
}