<?php
namespace Helmich\ProductsApiAdvanced\Normalizer\Decorator;

use Helmich\RestTools\Rest\Normalizer\NormalizerInterface;
use TYPO3\Flow\Mvc\Routing\UriBuilder;

class ProductHypermediaDecorator implements NormalizerInterface {

	/** @var UriBuilder */
	protected $uriBuilder;

	/** @var NormalizerInterface */
	protected $actual;

	public function __construct(NormalizerInterface $actual, UriBuilder $uriBuilder) {
		$this->uriBuilder = $uriBuilder;
		$this->actual     = $actual;
	}

	public function objectToScalar($object) {
		$scalar          = $this->actual->objectToScalar($object);
		$scalar['href']  = $this->uriBuilder->reset()->uriFor('show', ['product' => $object], 'Product');
		$scalar['links'] = [
			[
				'rel'  => 'inventoryChanges',
				'href' => $this->uriBuilder->reset()->uriFor('list', ['product' => $object], 'InventoryChange')
			]
		];

		return $scalar;
	}
}