<?php
namespace Helmich\Products\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Entity
 * @Flow\Scope("prototype")
 */
class Manufacturer {

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $location;

	/**
	 * @param string $name
	 * @param string $location
	 */
	public function __construct($name, $location) {
		$this->name     = $name;
		$this->location = $location;
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