<?php
	// function to convert kelvins to celcius
	function covertKtoC($kelvin) {
		return number_format($kelvin - 273.15); 
	}

	// get data from open weather map REST API
	function getData($q) {
		// API key
		$appid = '5ec25e4aa9a5d4e41d545224fcf5d367';
		$service_url = 'api.openweathermap.org/data/2.5/weather?q='.$q.'&APPID='.$appid;

		// get data		
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
		$curl_response = curl_exec($curl);
		curl_close($curl);

		// store data
		$json = json_decode($curl_response, true);	 

		// return data
		return $json;
	}
?>