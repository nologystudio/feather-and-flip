<?php

class Sabre
{
     var $IPCC = '';
     var $USERNAME = '';
     var $PASSWORD = '';
     
     function Sabre()
     {
        $this->IPCC = variable_get('sabre_ipcc');
        $this->USERNAME = variable_get('sabre_username');
        $this->PASSWORD = variable_get('sabre_passw');
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
     
     private function Header_SecurityToken($securityToken)
     {
           $securityTokenHeader = array( 
                          'BinarySecurityToken' => $securityToken
                               );
           
           $header = new SoapHeader('http://schemas.xmlsoap.org/ws/2002/12/secext','Security',$securityTokenHeader);
           
           return $header;
     }
     
     
     /*
      * Create a session with sabre service and get security token and conversation id
      */
     private function CreateSession()
     {
        $service = wsclient_service_load('createsession');
        
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
            //$args['body']['POS']['Source']['PseudoCityCode'] = $this->IPCC;
            //$response = $service->invoke('SessionCreateRQ', $args);
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
     
     /*
      * Close a session 
      */
     private function CloseSession($securityToken, $conversationId)
     {
        $service = wsclient_service_load('closesession');
        
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
     }
     
     /*
      * Format XML for print
      */
     private function ReadXML($xml)
     {
        $dom = new DOMDocument;
        $dom->preserveWhiteSpace = FALSE;
        $dom->loadXML($xml);
        $dom->formatOutput = TRUE;
        return $dom->saveXml();
     }
     
         
     public function HotelAvail()
     {
        $sessionInfo = $this->CreateSession();
        
        //TODO: Code for to complete function here
        
        $this->CloseSession($sessionInfo['SecurityToken'], $sessionInfo['ConversationId']);
     }
     
     public function HotelDescription()
     {
        $sessionInfo = $this->CreateSession();
        
        //TODO: Code for to complete function here
        
        $this->CloseSession($sessionInfo['SecurityToken'], $sessionInfo['ConversationId']);
     }
}