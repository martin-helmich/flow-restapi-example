<?php
namespace Helmich\ProductsApiAdvanced\Normalizer\Decorator;

use Helmich\RestTools\Rest\Normalizer\NormalizerInterface;
use TYPO3\Flow\Mvc\Routing\UriBuilder;

class ManufacturerHypermediaDecorator implements NormalizerInterface {

	/** @var UriBuilder */
	protected $uriBuilder;

	/** @var NormalizerInterface */
	protected $actual;

	/** @var bool */
	protected $withLinks;

	public function __construct(NormalizerInterface $actual, $withLinks, UriBuilder $uriBuilder) {
		$this->uriBuilder = $uriBuilder;
		$this->actual     = $actual;
		$this->withLinks  = $withLinks;
	}

	public function objectToScalar($object) {
		$scalar          = $this->actual->objectToScalar($object);
		$scalar['href']  = $this->uriBuilder->reset()->uriFor('show', ['manufacturer' => $object], 'Manufacturer');

		if ($this->withLinks) {
			$scalar['links'] = [
				[
					'rel'  => 'products',
					'href' => $this->uriBuilder->reset()->uriFor('listByManufacturer', ['manufacturer' => $object], 'Product')
				]
			];
		}

		return $scalar;
	}
}