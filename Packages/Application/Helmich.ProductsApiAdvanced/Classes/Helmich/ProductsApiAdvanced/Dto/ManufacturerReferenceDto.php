<?php
namespace Helmich\ProductsApiAdvanced\Dto;

use TYPO3\Flow\Annotations as Flow;

class ManufacturerReferenceDto {

	/**
	 * @var string
	 * @Flow\Validate(type="Uuid")
	 */
	protected $identifier;

	/**
	 * @param string $identifier
	 */
	public function __construct($identifier) {
		$this->identifier = $identifier;
	}

	/**
	 * @return string
	 */
	public function getIdentifier() {
		return $this->identifier;
	}
}