<?php
namespace Helmich\ProductsApiAdvanced\Controller;

use Helmich\Products\Domain\Model\InventoryChange;
use Helmich\Products\Domain\Model\Product;
use Helmich\ProductsApiAdvanced\Normalizer\InventoryChangeNormalizer;
use Helmich\RestTools\Mvc\Controller\RestController;
use Helmich\RestTools\Mvc\View\SerializingViewInterface;
use TYPO3\Flow\Mvc\View\ViewInterface;

class InventoryChangeController extends RestController {

	public function initializeView(ViewInterface $view) {
		if ($view instanceof SerializingViewInterface) {
			$view->registerNormalizerForClass(InventoryChange::class, new InventoryChangeNormalizer());
		}
	}

	public function listAction(Product $product) {
		$changes = $product->getInventoryChanges();
		$this->view->assign('inventoryChanges', $changes);
	}
}