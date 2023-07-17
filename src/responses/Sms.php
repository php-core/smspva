<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class Sms extends ApiResponse
{
	protected string $number;
	protected string $sms;
}
