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
	*	@param hotelId, checkin, checkout, rooms, numAdults, numChildren
	*/
	public function RoomAvailability($hotelId, $checkin, $checkout, $rooms, $numAdults, $numChildren)
	{
		$service = wsclient_service_load('expedia__rest');
		$service->settings['http_headers'] = array(
			'Content-Type' => array('multipart/form-data'),
		);

		// Set roomGroup data
		$roomGroup = array(
			'Room' =>	array(
				'numberOfAdults' 	=>	$numAdults,
				'numberOfChildren' 	=>	$numChildren,
				'childAges' 		=> 	'4,6'
			)
		);

		$res = null;
		try {
			$res = $service->expedia__rest_room_avail($hotelId, $checkin, $checkout, json_encode($roomGroup));
		} catch (Exception $e) {
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