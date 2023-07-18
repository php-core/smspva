<?php

namespace PHPCore\SmsPva;

abstract class ApiResponse
{
	protected ?string $response = null;

	/**
	 * @throws \Exception
	 */
	public function __construct(array $responseArray)
	{
		foreach ($responseArray as $key => $value) {
			if (property_exists($this, $key)) {
				$this->$key = $value;
			}
		}
		$reflection = new \ReflectionClass($this);
		foreach ($reflection->getProperties() as $property) {
			if (!$property->isInitialized($this)) {
				throw new \Exception('Property "' . $property->getName() . '" was not initialized');
			}
		}
	}

	/**
	 * @return string|null
	 */
	public function getResponseType(): ?string
	{
		return $this->response;
	}
}
