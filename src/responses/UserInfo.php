<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class UserInfo extends ApiResponse
{
	protected float $balance;
	protected int $karma;
	protected string $name;

	/**
	 * @return float
	 */
	public function getBalance(): float
	{
		return $this->balance;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}
