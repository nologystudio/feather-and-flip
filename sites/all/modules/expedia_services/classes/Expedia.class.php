<?php

class Expedia
{
	/*
	*	Get holtel list for city name, country code
	*	@param city
	* 	@param countryCode
	*/
	public static function CityHotels($city, $country = '')
	{
		$service = wsclient_service_load('expedia__rest');
		$service->settings['http_headers'] = array(
			'Content-Type' => array('multipart/form-data'),
		);


		$service->settings['curl options'] = array(
			CURLOPT_POSTFIELDS => array(
				'city' => $city,
				'countryCode' => $country,
				'numberOfResults' => 12)
		);

		$res = null;
		try {
			$res = $service->expedia__rest_hotel_list();
		} catch (Exception $e) {
			return $e->getMessage();
		}
		return $res;
	}

    public static function GetHotelsByCode($hotelCodes, $checkin, $checkout, $roomConfig)
    {
        $service = wsclient_service_load('expedia__rest');
        $service->settings['http_headers'] = array(
            'Content-Type' => array('multipart/form-data'),
        );

        // Parsing room configuration data
        foreach ($roomConfig as $room) {
            $roomGroup[] = array(
                'Room' => array(
                    'numberOfAdults'    => $room['adults'],
                    'numberOfChildren'  => (isset($room['children']) && ($room['children']['number'] > 0)) ? count($room['children']['ages']) : 0,
                    'childAges'         => (isset($room['children']) && ($room['children']['number'] > 0)) ? implode(',', $room['children']['ages']) : ''
                )
            );
        }

        $codes = implode(",",$hotelCodes);

        $res = null;
        try {
            $res = $service->expedia__rest_hotel_list_by_hotel_codes($codes, $checkin, $checkout, json_encode($roomGroup));
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $res;
    }

    public static function GetHotelsByCode_XML($hotelCodes, $checkin, $checkout, $roomConfig)
    {
        $service = wsclient_service_load('expedia__rest');
        $service->settings['http_headers'] = array(
            'Content-Type' => array('multipart/form-data'),
        );

       $xml="<HotelListRequest>
    <arrivalDate>$checkin</arrivalDate>
    <departureDate>$checkout</departureDate>
    <RoomGroup>";
        $rooms = "";
        foreach ($roomConfig as $room)
        {
            $rooms .= "<Room>";
            $rooms .="<numberOfAdults>".$room['adults']."</numberOfAdults>";
            if (isset($room['children']) && ($room['children']['number'] > 0))
            {
                $rooms .= "<numberOfChildren>".count($room['children']['ages'])."</numberOfChildren>";
                $rooms .= "<childAges>" . implode(',', $room['children']['ages']) . "</childAges>";
            }
            $rooms .= "</Room>";
        }

        $xml .= $rooms;
        $xml .= "</RoomGroup>
    <hotelIdList>". implode(',', $hotelCodes) ."</hotelIdList></HotelListRequest>";

        $res = null;
        try {
            $res = $service->expedia__rest_hotel_list_by_hotel_codes_xml($xml);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $res;
    }

	/*
	*	Get holtel info
	*	@param hid
	*/
	public static function GetHotelInfo($hid)
	{
		$service = wsclient_service_load('expedia__rest');
		$service->settings['http_headers'] = array(
			'Content-Type' => array('multipart/form-data'),
		);

		$res = null;
		try {
			$res = $service->expedia__rest_hotel_info($hid);
		} catch (Exception $e) {
			return $e->getMessage();
		}
		return $res;
	}

	/*
	*	Get room availability
	*	@param hotelId, checkin, checkout, roomConfig
	*/
	public static function RoomAvailability($hotelId, $checkin, $checkout, $roomConfig)
	{
		$service = wsclient_service_load('expedia__rest');
		$service->settings['http_headers'] = array(
			'Content-Type' => array('multipart/form-data'),
		);

        // Parsing room configuration data
        foreach ($roomConfig as $room) {
            $roomGroup[] = array(
                'Room' => array(
                    'numberOfAdults'    => $room['adults'],
                    'numberOfChildren'  => (isset($room['children']) && ($room['children']['number'] > 0)) ? count($room['children']['ages']) : 0,
                    'childAges'         => (isset($room['children']) && ($room['children']['number'] > 0)) ? implode(',', $room['children']['ages']) : ''
                )
            );
        }

		$res = null;
		try {
			$res = $service->expedia__rest_room_avail($hotelId, $checkin, $checkout, json_encode($roomGroup));
		} catch (Exception $e) {
			return $e->getMessage();
		}
		return $res;
	}

    public static function RoomAvailability_XML($hotelId, $checkin, $checkout, $roomConfig)
    {
        $service = wsclient_service_load('expedia__rest');
        $service->settings['http_headers'] = array(
            'Content-Type' => array('multipart/form-data'),
        );

        $xml="<HotelRoomAvailabilityRequest>
    <hotelId>$hotelId</hotelId>
    <arrivalDate>$checkin</arrivalDate>
    <departureDate>$checkout</departureDate>
    <includeDetails>true</includeDetails>
    <RoomGroup>";
        $rooms = "";
        foreach ($roomConfig as $room)
        {
            $rooms .= "<Room>";
            $rooms .="<numberOfAdults>".$room['adults']."</numberOfAdults>";
            if (isset($room['children']) && ($room['children']['number'] > 0))
            {
                $rooms .= "<numberOfChildren>".count($room['children']['ages'])."</numberOfChildren>";
                $rooms .= "<childAges>" . implode(',', $room['children']['ages']) . "</childAges>";
            }
            $rooms .= "</Room>";
        }

        $xml .= $rooms;
        $xml .= "</RoomGroup></HotelRoomAvailabilityRequest>";

        $res = null;
        try {
            $res = $service->expedia__rest_room_avail_xml($xml);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $res;
    }

    /*
    *	Get room availability for list hotels
    *	@param hotelId, checkin, checkout, roomConfig
    */
    public static function ListRoomsAvailability($listhotelId, $checkin, $checkout, $roomConfig)
    {
        $res = array();

        foreach($listhotelId as $hotelId)
            $res[] = self::RoomAvailability($hotelId,$checkin,$checkout,$roomConfig);

        return $res;
    }

    /**
     * Booking of hotel
     * @param $hotelId
     * @param $checkin
     * @param $checkout
     * @param $numAdults
     * @param $numChildren
     * @param $roomcode
     * @param $ratecode
     * @param $numAdults
     * @param $numChildren
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $phone
     * @param $creditCardType
     * @param $creaditCardNumber
     * @param $creditCardIdentifier
     * @param $creditCardExpirationMonth
     * @param $creditCardExpirationYear
     * @return null|string
     */
    public static function HotelBookReservation($hotelId, $checkin, $checkout,$roomConfig, $roomcode, $ratecode, $rateKey, $supplierType, $chargeableRate,
                                                $firstname, $lastname, $email, $phone, $creditCardType, $creaditCardNumber, $creditCardIdentifier,
                                                $creditCardExpirationMonth, $creditCardExpirationYear)
    {
        $service = wsclient_service_load('expedia__rest');
        $service->settings['http_headers'] = array(
            //'Content-Type' => array('multipart/form-data'),
            'Content-Type' => array('application/x-www-form-urlencoded')
        );

        $service->url = 'https://book.api.ean.com';

        $xml =
"<HotelRoomReservationRequest>
    <hotelId>$hotelId</hotelId>
    <arrivalDate>$checkin</arrivalDate>
    <departureDate>$checkout</departureDate>
    <supplierType>$supplierType</supplierType>
    <rateKey>$rateKey</rateKey>
    <roomTypeCode>$roomcode</roomTypeCode>
    <rateCode>$ratecode</rateCode>
    <chargeableRate>$chargeableRate</chargeableRate>
    <RoomGroup>";
        $rooms = "";
        foreach ($roomConfig as $room)
        {
            $rooms .= "<Room>";
            $rooms .="<numberOfAdults>".$room['adults']."</numberOfAdults>";
            if (isset($room['children']) && ($room['children']['number'] > 0))
            {
                $rooms .= "<numberOfChildren>".count($room['children']['ages'])."</numberOfChildren>";
                $rooms .= "<childAges>" . implode(',', $room['children']['ages']) . "</childAges>";
            }
            $rooms .= "<firstName>$firstname</firstName>";
            $rooms .= "<lastName>$lastname</lastName>";
            $rooms .= "</Room>";
        }

        $xml .= $rooms;

        $xml .= "</RoomGroup>
    <ReservationInfo>
        <email>$email</email>
        <firstName>$firstname</firstName>
        <lastName>$lastname</lastName>
        <homePhone>$phone</homePhone>
        <creditCardType>$creditCardType</creditCardType>
        <creditCardNumber>$creaditCardNumber</creditCardNumber>
        <creditCardIdentifier>$creditCardIdentifier</creditCardIdentifier>
        <creditCardExpirationMonth>$creditCardExpirationMonth</creditCardExpirationMonth>
        <creditCardExpirationYear>$creditCardExpirationYear</creditCardExpirationYear>
    </ReservationInfo>
    <AddressInfo>
        <address1>travelnow</address1>
        <city>Seattle</city>
        <stateProvinceCode>WA</stateProvinceCode>
        <countryCode>US</countryCode>
        <postalCode>98004</postalCode>
    </AddressInfo>
</HotelRoomReservationRequest>";


/*
$xml = "<HotelRoomReservationRequest>
    <hotelId>106347</hotelId>
    <arrivalDate>1/22/2015</arrivalDate>
    <departureDate>1/24/2015</departureDate>
    <supplierType>E</supplierType>
    <rateKey>af00b688-acf4-409e-8bdc-fcfc3d1cb80c</rateKey>
    <roomTypeCode>198058</roomTypeCode> 
    <rateCode>484072</rateCode>
    <chargeableRate>231.18</chargeableRate>
    <RoomGroup>
        <Room>
            <numberOfAdults>2</numberOfAdults>
            <firstName>test</firstName>
            <lastName>tester</lastName>
            <bedTypeId>23</bedTypeId>
            <smokingPreference>NS</smokingPreference>
        </Room>
    </RoomGroup>
    <ReservationInfo>
        <email>test@travelnow.com</email>
        <firstName>test</firstName>
        <lastName>tester</lastName>
        <homePhone>2145370159</homePhone>
        <workPhone>2145370159</workPhone>
        <creditCardType>CA</creditCardType>
        <creditCardNumber>5401999999999999</creditCardNumber>
        <creditCardIdentifier>123</creditCardIdentifier>
        <creditCardExpirationMonth>11</creditCardExpirationMonth>
        <creditCardExpirationYear>2016</creditCardExpirationYear>
    </ReservationInfo>
    <AddressInfo>
        <address1>travelnow</address1>
        <city>Seattle</city>
        <stateProvinceCode>WA</stateProvinceCode>
        <countryCode>US</countryCode>
        <postalCode>98004</postalCode>
    </AddressInfo>
</HotelRoomReservationRequest>";*/

/*
        // Set roomGroup data
        foreach ($roomConfig as $room) {
            $roomGroup[] = array(
                'Room' => array(
                    'numberOfAdults' => $room['adults'],
                    'numberOfChildren' => (isset($room['children']) && ($room['children']['number'] > 0)) ? count($room['children']['ages']) : 0,
                    'childAges' => (isset($room['children']) && ($room['children']['number'] > 0)) ? implode(',', $room['children']['ages']) : '',
                    'firstName' => $firstname,
                    'lastName' => $lastname
                )
            );
        }



        // Set ReservationInfo data
        $reservationInfo = array(
            'email'                     => $email,
            'firstName'                 => $firstname,
            'lastName'                  => $lastname,
            'homePhone'                 => $phone,
            'creditCardType'            => $creditCardType,
            'creditCardNumber'          => $creaditCardNumber,
            'creditCardIdentifier'      => $creditCardIdentifier,
            'creditCardExpirationMonth' => $creditCardExpirationMonth,
            'creditCardExpirationYear'  => $creditCardExpirationYear
        );



        //AddressInfo
        $addressInfo = array(
            'address1' => 'travelnow',
            'city' => 'Seattle',
            'stateProvinceCode' => 'WA',
            'countryCode' => 'US',
            'postalCode' => '98004'
        );
*/


        $res = null;

        /*
        $service->settings['curl options'] = array(
            CURLOPT_POSTFIELDS => array(
                'hotelId' => $hotelId,
                'arrivalDate' => $checkin,
                'departureDate' => $checkout,
                'roomTypeCode' => $roomcode,
                'rateCode' => $ratecode,
                'RoomGroup' => json_encode($roomGroup),
                'ReservationInfo' => json_encode($reservationInfo),
                'AddressInfo' => json_encode($addressInfo),
                'supplierType' => 'E',
                'rateKey' => '9dea54b4-2b95-4346-9ae1-3185757a96e9'
        ));
        */

        try{
            //$res = $service->expedia__rest_room_reservation($hotelId, $checkin, $checkout, $roomcode, $ratecode, json_encode($roomGroup), json_encode($reservationInfo), json_encode($addressInfo),'E', '9dea54b4-2b95-4346-9ae1-3185757a96e9');
            $res = $service->expedia__rest_room_reservation_xml($xml);
	    //dpm(self::ReadXML($xml));

        }
        catch(Exception $e){
            return $e->getMessage();
        }

        return $res;
    }

    /*
    *   Get lowRate from a HotelRates response
    *   for hotelId parameter
    *   @param Expedia object HotelRates response
    *   @param hotelId
    *   
    */
    public static function GetLowRateFromResponse($ratesResponse, $hotelId)
    {
        $rateInfo = array('rate' => 0.0, 'currency' => '');
        if (isset($ratesResponse['HotelList']) && isset($ratesResponse['HotelList']['HotelSummary'])) {
            //Por si solo hay un hotel
            if (isset($ratesResponse['HotelList']['HotelSummary']['hotelId']))
            {
                if ($ratesResponse['HotelList']['HotelSummary']['hotelId'] == $hotelId)
                    $rateInfo = array('rate' => $ratesResponse['HotelList']['HotelSummary']['lowRate'], 'currency' => $ratesResponse['HotelList']['HotelSummary']['rateCurrencyCode']);
            }
            else
            {
                foreach ($ratesResponse['HotelList']['HotelSummary'] as $key => $hotel) {
                    //dpm($hotel);
                    if ($hotel['hotelId'] == $hotelId) {
                        $rateInfo = array('rate' => $hotel['lowRate'], 'currency' => $hotel['rateCurrencyCode']);
                        break;
                    }
                }
            }
        }
        return $rateInfo;
    }

	/*
	*	Extract EAN error message
	*	@param Expedia object
	* 	
	*/
	public static function GetErrorMessage($obj)
	{
		return $obj['HotelListResponse']['EanWsError']['presentationMessage'];
	}
	
	
	/**
	 * Format XML for print
	 * @param $xml
	 * @return string
	 */
	 private static function ReadXML($xml)
	 {
	    $dom = new DOMDocument;
	    $dom->preserveWhiteSpace = FALSE;
	    $dom->loadXML($xml);
	    $dom->formatOutput = TRUE;
	    return $dom->saveXml();
	 }	
}