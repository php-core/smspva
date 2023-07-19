<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class ClearSms extends ApiResponse
{
	protected string $clearsms;

	public function isOk(): bool
	{
		return $this->clearsms === 'ok';
	}
}
