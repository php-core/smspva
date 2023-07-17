<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class Price extends ApiResponse
{
	protected string $Service;
	protected string $ServiceName;
	protected float $Price;
	protected string $Country;
}
