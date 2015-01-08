<?php
namespace Helmich\ProductsApiSimple\Controller;

use Helmich\Products\Domain\Model\Product;
use Helmich\Products\Domain\Repository\ProductRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Mvc\View\JsonView;
use TYPO3\Flow\Mvc\View\ViewInterface;
use TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter;

class ProductController extends ActionController {

	protected $supportedMediaTypes = ['application/json'];

	protected $viewFormatToObjectNameMap = ['json' => JsonView::class];

	/**
	 * @var ProductRepository
	 * @Flow\Inject
	 */
	protected $productRepository;

	protected function initializeView(ViewInterface $view) {
		if ($view instanceof JsonView) {
			$productConfiguration = [
				'_exposeObjectIdentifier'     => TRUE,
				'_exposedObjectIdentifierKey' => 'identifier',
				'_descend'                    => [
					'manufacturer' => [
						'_exclude'                    => ['__isInitialized__'],
						'_exposeObjectIdentifier'     => TRUE,
						'_exposedObjectIdentifierKey' => 'identifier'
					]
				]
			];
			$view->setConfiguration([
				'value' => [
					'products' => ['_descendAll' => $productConfiguration],
					'product'  => $productConfiguration
				]
			]);
		}
	}

	public function listAction() {
		$products = $this->productRepository->findAll();
		$this->view->assign('value', ['products' => $products]);
	}

	public function showAction(Product $product) {
		$this->view->assign('value', ['product' => $product]);
	}

	protected function initializeCreateAction() {
		$config = $this->arguments['product']->getPropertyMappingConfiguration();
		$config->setTypeConverterOption('TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter', PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, TRUE);
		$config->allowAllProperties();
	}

	public function createAction(Product $product) {
		$this->productRepository->add($product);
		$this->response->setStatus(201);
		$this->view->assign('value', ['product' => $product]);
	}

	protected function initializeUpdateAction() {
		$config = $this->arguments['product']->getPropertyMappingConfiguration();
		$config->setTypeConverterOption('TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter', PersistentObjectConverter::CONFIGURATION_MODIFICATION_ALLOWED, TRUE);
		$config->allowAllProperties();
	}

	public function updateAction(Product $product) {
		$this->productRepository->update($product);
		$this->view->assign('value', ['product' => $product]);
	}

	public function deleteAction(Product $product) {
		$this->productRepository->remove($product);
		$this->response->setStatus(204);
	}

}