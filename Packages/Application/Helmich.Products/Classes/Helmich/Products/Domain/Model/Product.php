<?php
namespace Helmich\Products\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Entity
 * @Flow\Scope("prototype")
 */
class Product {

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var int
	 */
	protected $quantity;

	/**
	 * @var float
	 * @ORM\Column(type="decimal", precision=10, scale=2)
	 */
	protected $price;

	/**
	 * @var Collection<InventoryChange>
	 * @ORM\OneToMany(mappedBy="product", cascade={"persist", "remove"})
	 */
	protected $inventoryChanges;

	/**
	 * @var Manufacturer
	 * @ORM\ManyToOne(cascade={"persist"})
	 */
	protected $manufacturer;

	/**
	 * Default constructor.
	 *
	 * @param string       $name         The product name.
	 * @param float        $price        The product price.
	 * @param Manufacturer $manufacturer The manufacturer.
	 * @param int          $quantity     The initial quantity.
	 */
	public function __construct($name, $price, Manufacturer $manufacturer, $quantity = 0) {
		$this->name             = $name;
		$this->quantity         = $quantity;
		$this->price            = $price;
		$this->manufacturer     = $manufacturer;
		$this->inventoryChanges = new ArrayCollection();

		if ($quantity != 0) {
			$this->inventoryChanges->add(new InventoryChange($this, $quantity, 'Initial stock'));
		}
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 */
	public function setQuantity($quantity) {
		$difference = $quantity - $this->quantity;
		if ($difference !== 0) {
			if ($difference > 0) {
				$purpose = 'Added items to stock.';
			} else {
				$purpose = 'Removed items from stock.';
			}

			$this->addInventoryChange(new InventoryChange($this, $difference, $purpose));
		}
	}

	/**
	 * @return float
	 */
	public function getPrice() {
		return (float)$this->price;
	}

	/**
	 * @param float $price
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * @return Collection
	 */
	public function getInventoryChanges() {
		return $this->inventoryChanges;
	}

	/**
	 * @param InventoryChange $inventoryChange
	 */
	public function addInventoryChange(InventoryChange $inventoryChange) {
		$this->quantity += $inventoryChange->getAmount();
		$this->inventoryChanges->add($inventoryChange);
	}

	/**
	 * @return Manufacturer
	 */
	public function getManufacturer() {
		return $this->manufacturer;
	}

	/**
	 * @param Manufacturer $manufacturer
	 */
	public function setManufacturer(Manufacturer $manufacturer) {
		$this->manufacturer = $manufacturer;
	}


}