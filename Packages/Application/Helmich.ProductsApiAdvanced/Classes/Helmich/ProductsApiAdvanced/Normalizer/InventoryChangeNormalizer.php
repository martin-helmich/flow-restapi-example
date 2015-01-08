<?php
namespace Helmich\ProductsApiAdvanced\Normalizer;

use Helmich\Products\Domain\Model\InventoryChange;
use Helmich\RestTools\Rest\Normalizer\NormalizerInterface;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\PersistenceManagerInterface;

class InventoryChangeNormalizer implements NormalizerInterface {

	/**
	 * @var PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	public function objectToScalar($object) {
		if ($object instanceof InventoryChange) {
			$identifier = $this->persistenceManager->getIdentifierByObject($object);
			return [
				'identifier' => $identifier,
				'quantity'   => $object->getAmount(),
				'date'       => $object->getDate()->format('r')
			];
		}
		throw new \InvalidArgumentException('Expected instanceof ' . InventoryChange::class . ', got ' . get_class($object) . '!');
	}

}