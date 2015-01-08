<?php
namespace Helmich\Products\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Entity
 * @Flow\Scope("prototype")
 */
class InventoryChange {

	/**
	 * @var Product
	 * @ORM\ManyToOne(inversedBy="inventoryChanges")
	 */
	protected $product;

	/**
	 * @var int
	 */
	protected $amount;

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var string
	 */
	protected $purpose;

	/**
	 * @param Product $product The affected product.
	 * @param int     $amount  The differential amount.
	 * @param string  $purpose The purpose of the inventory change.
	 */
	public function __construct(Product $product, $amount, $purpose = '') {
		$this->product = $product;
		$this->amount  = $amount;
		$this->purpose = $purpose;
		$this->date    = new \DateTime();
	}

	/**
	 * @return Product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * @return int
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

}