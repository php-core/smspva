<?php

namespace PHPCore\SmsPva;

class ApiException extends \Exception
{
	protected $apiErrorCode;

	public function __construct($message = "", $code = 0, $apiErrorCode = null, ?\Throwable $previous = null)
	{
		$this->apiErrorCode = $apiErrorCode;
		parent::__construct($message, $code, $previous);
	}

	public function getApiErrorCode()
	{
		return $this->apiErrorCode;
	}
}
