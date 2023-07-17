<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class Number extends ApiResponse
{
	protected int $id;
	protected string $number;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getNumber(): string
	{
		return $this->number;
	}
}
