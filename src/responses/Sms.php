<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class Sms extends ApiResponse
{
	protected string $number;
	protected string $sms;

	/**
	 * @return string
	 */
	public function getNumber(): string
	{
		return $this->number;
	}

	/**
	 * @return string
	 */
	public function getSms(): string
	{
		return $this->sms;
	}
}
