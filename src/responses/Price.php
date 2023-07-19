<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class Price extends ApiResponse
{
	protected string $Service;
	protected string $ServiceName;
	protected float $Price;
	protected string $Country;

	/**
	 * @return string
	 */
	public function getService(): string
	{
		return $this->Service;
	}

	/**
	 * @return string
	 */
	public function getServiceName(): string
	{
		return $this->ServiceName;
	}

	/**
	 * @return float
	 */
	public function getPrice(): float
	{
		return $this->Price;
	}

	/**
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->Country;
	}
}
