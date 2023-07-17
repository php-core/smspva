<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class Balance extends ApiResponse
{
	protected float $balance;

	/**
	 * @return float
	 */
	public function getBalance(): float
	{
		return $this->balance;
	}
}
