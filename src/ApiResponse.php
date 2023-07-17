<?php

namespace PHPCore\SmsPva;

abstract class ApiResponse
{
	protected int $response;

	public function __construct(array $responseArray)
	{
		foreach ($responseArray as $key => $value) {
			if (property_exists($this, $key)) {
				$this->$key = $value;
			}
		}
	}

	/**
	 * @return int
	 */
	public function getResponseType(): int
	{
		return $this->response;
	}
}
