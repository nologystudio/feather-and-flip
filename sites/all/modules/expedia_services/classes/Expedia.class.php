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
    public static function HotelBookReservation($hotelId, $checkin, $checkout,$numAdults, $numChildren, $roomcode, $ratecode,
                                                $firstname, $lastname, $email, $phone, $creditCardType, $creaditCardNumber, $creditCardIdentifier,
                                                $creditCardExpirationMonth, $creditCardExpirationYear)
    {
        $service = wsclient_service_load('expedia__rest');
        $service->settings['http_headers'] = array(
            //'Content-Type' => array('multipart/form-data'),
            'Content-Type' => array('application/x-www-form-urlencoded'),
        );

        // Set roomGroup data
        $roomGroup = array(
            'Room' =>	array(
                'numberOfAdults' 	=>	$numAdults,
                'numberOfChildren' 	=>	$numChildren,
                'childAges' 		=> 	'4',
                'firstName'         => $firstname,
                'lastName'          => $lastname,
                'bedTypeId'         => '14'
            )
        );

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

        $res = null;

        $service->settings['curl options'] = array(
            CURLOPT_POSTFIELDS => array(
                'hotelId' => $hotelId,
                'arrivalDate' => $checkin,
                'departureDate' => $checkout,
                'roomTypeCode' => $roomcode,
                'rateCode' => $ratecode,
                'RoomGroup' => json_encode($roomGroup),
                'ReservationInfo' => /*json_encode($reservationInfo)*/ implode(",",$reservationInfo))
        );

        try{
            //$res = $service->expedia__rest_room_reservation($hotelId, $checkin, $checkout, $roomcode, $ratecode, json_encode($roomGroup), json_encode($reservationInfo));
            $res = $service->expedia__rest_room_reservation();
        }
        catch(Exception $e){
            return $e->getMessage();
        }

        return $res;
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
}