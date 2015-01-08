<?php
namespace Helmich\ProductsApiAdvanced\Normalizer;

use Helmich\Products\Domain\Model\Manufacturer;
use Helmich\RestTools\Rest\Normalizer\NormalizerInterface;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ControllerContext;
use TYPO3\Flow\Persistence\PersistenceManagerInterface;

class ManufacturerNormalizer implements NormalizerInterface {

	/**
	 * @var PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	public function objectToScalar($object) {
		if (!$object instanceof Manufacturer) {
			throw new \InvalidArgumentException('Expected ' . Manufacturer::class . ', got ' . get_class($object) . '!');
		}

		return [
			'identifier' => $this->persistenceManager->getIdentifierByObject($object),
			'name'       => $object->getName(),
			'location'   => $object->getLocation()
		];
	}

}