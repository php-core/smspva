<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class Prices extends ApiResponse
{
	/** @var Price[] $prices */
	protected array $prices = [];

	public function __construct(array $responseArray)
	{
		parent::__construct([]);
		foreach ($responseArray as $priceData) {
			$this->prices[] = new Price($priceData);
		}
	}

	/**
	 * @return Price[]
	 */
	public function getPrices(): array
	{
		return $this->prices;
	}
}
