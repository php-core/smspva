<?php

namespace PHPCore\SMSPVA\Response;

use PHPCore\SmsPva\ApiResponse;

class CountNew extends ApiResponse
{
	protected string $service;
	protected int $online;
	protected int $total;
	protected int $forTotal;
	protected int $forOnline;
	protected string $country;
}
