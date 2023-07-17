# smspva
SmsPva.com PHP SDK

---

# Installation

``
composer require php-core/smspva
``

# Examples
### Get number

```
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
```
---
### Other examples can be found [here](https://github.com/php-core/smspva/blob/main/examples/all.php)

---
## For more, visit the [Official SMSPVA API Documentation](https://smspva.com/new_theme_api.html)

---

## License
This project is licensed under the MIT License.
