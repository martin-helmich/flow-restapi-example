<?php
namespace Helmich\Products\Command;

use Helmich\Products\Domain\Model\Manufacturer;
use Helmich\Products\Domain\Model\Product;
use Helmich\Products\Domain\Repository\ProductRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cli\CommandController;

/**
 * A simple command line controller for creating example data.
 *
 * @Flow\Scope("singleton")
 */
class ExampleDataCommandController extends CommandController {

	/**
	 * @var ProductRepository
	 * @Flow\Inject
	 */
	protected $productRepository;

	/**
	 * Populates the database with a small set of example data.
	 *
	 * @return void
	 */
	public function populateCommand() {
		$manufacturer = new Manufacturer('Helmich Inc.', 'Rahden');
		foreach (['Apple', 'Banana', 'Kiwi'] as $productName) {
			$price   = rand(100, 2000) / 100;
			$product = new Product($productName, $price, $manufacturer, rand(1, 20));
			$this->productRepository->add($product);
		}
	}
}