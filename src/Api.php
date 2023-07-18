<?php

namespace PHPCore\SmsPva;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPCore\SMSPVA\Response\Balance;
use PHPCore\SMSPVA\Response\CountNew;
use PHPCore\SMSPVA\Response\Number;
use PHPCore\SMSPVA\Response\Prices;
use PHPCore\SMSPVA\Response\ServicePrice;
use PHPCore\SMSPVA\Response\Sms;
use PHPCore\SMSPVA\Response\UserInfo;

class Api
{
	private static string $API_BASE_URL = 'https://smspva.com/priemnik.php';
	private static array $errorCodes = [
		5 => 'You have exceeded the number of requests per minute',
		6 => 'You will be banned for 10 minutes, because scored negative karma',
		7 => 'You have exceeded the number of concurrent streams. SMS Wait from previous orders',
	];
	private static array $errorMessages = [
		"API KEY NOT FOUND!" => "Invalid API KEY has been entered",
		"Недостаточно средств!" => "Insufficient funds",
		"Превышено количество попыток!" => "Set a longer interval between calls to API server",
		"Произошла неизвестная ошибка." => "Try to repeat your request later.",
		"Неверный запрос." => "Check the request syntax and the list of parameters used (can be found on the page with method description).",
		"Произошла внутренняя ошибка сервера." => "Try to repeat your request later.",
	];

	private string $apiKey;
	private ?array $guzzleConfig;

	public function __construct(string $apiKey, ?array $guzzleConfig = [])
	{
		$this->apiKey = $apiKey;
		$this->guzzleConfig = $guzzleConfig;
	}

	public function getCountryList(): array
	{
		return json_decode(
			file_get_contents(dirname(__DIR__) . '/var/data/countries.json'),
			true
		);
	}

	public function getServiceList(): array
	{
		return json_decode(
			file_get_contents(dirname(__DIR__) . '/var/data/services.json'),
			true
		);
	}

	/**
	 * @throws Exception
	 */
	public function getBalance(): Balance
	{
		return new Balance($this->makeRequest([
			'metod' => 'get_balance',
		]));
	}

	/**
	 * @throws Exception
	 */
	public function getUserInfo(): UserInfo
	{
		return new UserInfo($this->makeRequest([
			'metod' => 'get_userinfo',
		]));
	}

	/**
	 * @throws Exception
	 */
	public function getCountNew(string $service, ?string $country = 'RU'): CountNew
	{
		return new CountNew($this->makeRequest([
			'metod' => 'get_count_new',
			'service' => $service,
			'country' => $country,
		]));
	}

	/**
	 * @throws Exception
	 */
	public function getServicePrice(string $service, string $country, ?string $operator = null): ServicePrice
	{
		$queryParams = [
			'metod' => 'get_service_price',
			'service' => $service,
			'country' => $country,
		];

		if (!empty($operator)) {
			$queryParams['operator'] = $operator;
		}

		return new ServicePrice($this->makeRequest($queryParams));
	}

	/**
	 * @throws Exception
	 */
	public function getPrices(?string $country = 'RU'): Prices
	{
		$queryParams = [
			'metod' => 'get_prices',
		];

		if (!empty($country)) {
			$queryParams['country'] = $country;
		}

		return new Prices($this->makeRequest($queryParams));
	}

	/**
	 * @throws Exception
	 */
	public function getNumber(string $service, string $country, ?string $operator = null): Number
	{
		$queryParams = [
			'metod' => 'get_number',
			'service' => $service,
			'country' => $country,
		];

		if (!empty($operator)) {
			$queryParams['operator'] = $operator;
		}

		return new Number($this->makeRequest($queryParams));
	}

	/**
	 * @throws Exception
	 */
	public function ban(string $service, int $numberId): array
	{
		return $this->makeRequest([
			'metod' => 'ban',
			'service' => $service,
			'id' => $numberId,
		]);
	}

	/**
	 * @throws Exception
	 */
	public function getSms(string $service, string $country, int $numberId): Sms
	{
		return new Sms($this->makeRequest([
			'metod' => 'get_sms',
			'service' => $service,
			'country' => $country,
			'id' => $numberId,
		]));
	}

	/**
	 * @throws Exception
	 */
	public function denial(string $service, string $country, int $numberId): array
	{
		return $this->makeRequest([
			'metod' => 'denial',
			'service' => $service,
			'country' => $country,
			'id' => $numberId,
		]);
	}

	/**
	 * @throws Exception
	 */
	public function getClearSms(string $service, int $orderId): array
	{
		return $this->makeRequest([
			'metod' => 'get_clearsms',
			'service' => $service,
			'id' => $orderId,
		]);
	}

	/**
	 * @throws Exception
	 */
	public function getProverka(string $service, string $number): array
	{
		return $this->makeRequest([
			'metod' => 'get_proverka',
			'service' => $service,
			'number' => $number,
		]);
	}

	/**
	 * @throws Exception
	 */
	public function balanceSim(string $service, int $id): array
	{
		return $this->makeRequest([
			'metod' => 'balance_sim',
			'service' => $service,
			'id' => $id,
		]);
	}

	/**
	 * @throws Exception
	 */
	public function get2FA(string $secret): array
	{
		$queryParams = [
			'metod' => 'get_2fa',
			'secret' => $secret,
		];

		return $this->makeRequest($queryParams);
	}

	/**
	 * @throws Exception
	 */
	private function makeRequest(array $queryParams): array
	{
		$client = new Client($this->guzzleConfig);

		try {
			$response = $client->request('GET', self::$API_BASE_URL, [
				'query' => array_merge($queryParams, [
					'apikey' => $this->apiKey,
				]),
			]);

			$body = $response->getBody()->getContents();
			$decodedBody = json_decode($body, true);

			if (json_last_error() !== JSON_ERROR_NONE) {
				if (in_array($body, array_keys(self::$errorMessages))) {
					throw new ApiException(
						self::$errorMessages[$body]
					);
				}
				throw new Exception('Failed to decode API response: ' . $body);
			}

			if (isset($decodedBody['error'])) {
				throw new ApiException($decodedBody['error']);
			}
			if (isset($decodedBody['response'])
				&& (
					$decodedBody['response'] === 'error' || (int)$decodedBody['response'] !== 1
				)) {
				if (isset($decodedBody['error_msg'])) {
					throw new ApiException($decodedBody['error_msg']);
				}
				if (isset($decodedBody['not_number'])) {
					throw new ApiException($decodedBody['not_number']);
				}
				if (in_array($decodedBody['response'], array_keys(self::$errorCodes))) {
					throw new ApiException(
						self::$errorCodes[$decodedBody['response']]
					);
				}
				if (isset($decodedBody['clearsms'])) {
					throw new ApiException($decodedBody['clearsms']);
				}
				throw new ApiException('Error for following response: ' . $body);
			}

			return $decodedBody;
		} catch (GuzzleException $e) {
			throw new ApiException('Request to SmsPva API failed: ' . $e->getMessage());
		}
	}
}
