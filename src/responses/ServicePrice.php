<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class ServicePrice extends ApiResponse
{
	protected string $country;
	protected string $service;
	protected float $price;

	/**
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * @return string
	 */
	public function getService(): string
	{
		return $this->service;
	}

	/**
	 * @return float
	 */
	public function getPrice(): float
	{
		return $this->price;
	}
}
