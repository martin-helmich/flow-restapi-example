<?php
namespace Helmich\ProductsApiAdvanced\Normalizer;

use Helmich\Products\Domain\Model\Product;
use Helmich\RestTools\Rest\Normalizer\NormalizerInterface;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ControllerContext;
use TYPO3\Flow\Persistence\PersistenceManagerInterface;

class ProductNormalizer implements NormalizerInterface {

	/**
	 * @var PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	public function objectToScalar($object) {
		if ($object instanceof Product) {
			$identifier = $this->persistenceManager->getIdentifierByObject($object);
			return [
				'identifier'   => $identifier,
				'name'         => $object->getName(),
				'quantity'     => $object->getQuantity(),
				'price'        => $object->getPrice(),
				'manufacturer' => $object->getManufacturer()
			];
		}
		throw new \InvalidArgumentException('Expected instanceof ' . Product::class . ', got ' . get_class($object) . '!');
	}

}