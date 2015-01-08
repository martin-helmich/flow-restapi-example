<?php
namespace Helmich\ProductsApiAdvanced\Dto;

use TYPO3\Flow\Annotations as Flow;

/**
 * @package    Helmich\ProductsApiAdvanced
 * @subpackage Dto
 *
 * @Flow\Scope("prototype")
 */
class ProductDto {

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
	 * @var int
	 * @Flow\Validate(type="NotEmpty")
	 * @Flow\Validate(type="NumberRange")
	 */
	protected $quantity;

	/**
	 * @var float
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $price;

	/**
	 * @var ManufacturerReferenceDto
	 */
	protected $manufacturer;

	/**
	 * @param string                   $name
	 * @param int                      $quantity
	 * @param float                    $price
	 * @param ManufacturerReferenceDto $manufacturer
	 * @param string                   $identifier
	 */
	public function __construct($name, $quantity, $price, ManufacturerReferenceDto $manufacturer, $identifier = NULL) {
		$this->identifier   = $identifier;
		$this->name         = $name;
		$this->quantity     = $quantity;
		$this->price        = $price;
		$this->manufacturer = $manufacturer;
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
	 * @return int
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @return float
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @return ManufacturerReferenceDto
	 */
	public function getManufacturer() {
		return $this->manufacturer;
	}

}