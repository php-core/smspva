<?php

// require_once './vendor/autoload.php';

// Replace 'YOUR_API_KEY' with your actual API key from SMS PVA.
$apiKey = 'YOUR_API_KEY';

try {
	$api = new PHPCore\SmsPva\Api($apiKey);

	// Example: Get user information
	// $userInfo = $api->getUserInfo();
	// print_r($userInfo);

	// Example: Get service price
	// $service = 'tg'; // Service code for Telegram (tg)
	// $country = 'RU'; // Country code for Russia (RU)
	// $price = $api->getServicePrice($service, $country);
	// print_r($price);

	// Example: Get SMS by tzid
	// $tzid = '1234567890'; // Replace with a valid tzid
	// $sms = $api->getSms($tzid);
	// print_r($sms);

	// Example: Deny SMS by tzid
	// $tzid = '1234567890'; // Replace with a valid tzid
	// $denialResponse = $api->denial($tzid);
	// print_r($denialResponse);

	// Example: Get clear SMS by tzid
	// $tzid = '1234567890'; // Replace with a valid tzid
	// $clearSms = $api->getClearSms($tzid);
	// print_r($clearSms);

	// Example: Get proverka information
	// $service = 'tg'; // Service code for Telegram (tg)
	// $number = '1234567890'; // Replace with a valid phone number
	// $proverka = $api->getProverka($service, $number);
	// print_r($proverka);

	// Example: Get balance for a specific service and country
	// $service = 'tg'; // Service code for Telegram (tg)
	// $country = 'RU'; // Country code for Russia (RU)
	// $balanceSim = $api->balanceSim($service, $country);
	// print_r($balanceSim);

	// Example: Get 2FA information for a service
	// $service = 'tg'; // Service code for Telegram (tg)
	// $twoFactorAuth = $api->get2FA($service);
	// print_r($twoFactorAuth);

} catch (Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
}
