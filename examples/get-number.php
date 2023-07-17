<?php

// require_once './vendor/autoload.php';

// Replace 'YOUR_API_KEY' with your actual API key from SMS PVA.
$apiKey = 'YOUR_API_KEY';

try {
	$api = new PHPCore\SmsPva\Api($apiKey);

	// Example: Getting a number for a specific service and country.
	$service = 'tg'; // Service code for Telegram (tg)
	$country = 'RU'; // Country code for Russia (RU)

	$response = $api->getNumber($service, $country);

	// Check the response to see if the request was successful.
	if (isset($response['number'])) {
		$number = $response['number'];
		$tzid = $response['id'];

		echo "Received number: $number\n";

		// Perform your actions with the received number.
		// ...
	} else {
		echo "Error: " . $response['error'] . "\n";
	}
} catch (Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
}
