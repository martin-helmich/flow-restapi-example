<?php
namespace Helmich\ProductsApiAdvanced\Dto;

use TYPO3\Flow\Annotations as Flow;

/**
 * @package    HelmichProductsApiAdvanced
 * @subpackage Dto
 *
 * @Flow\Scope("prototype")
 */
class ManufacturerDto {

	/**
	 * @var string
	 * @Flow\Validate(type="Uuid")
	 */
	protected $identifier;

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $name;

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $location;

	/**
	 * @param string $name
	 * @param string $location
	 * @param string $identifier
	 */
	public function __construct($name, $location, $identifier = NULL) {
		$this->identifier = $identifier;
		$this->name       = $name;
		$this->location   = $location;
	}

	/**
	 * @return string
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getLocation() {
		return $this->location;
	}

}