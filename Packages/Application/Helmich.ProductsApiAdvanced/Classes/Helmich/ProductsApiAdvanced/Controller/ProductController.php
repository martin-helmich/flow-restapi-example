<?php
namespace Helmich\ProductsApiAdvanced\Controller;

use Helmich\Products\Domain\Model\Manufacturer;
use Helmich\Products\Domain\Model\Product;
use Helmich\Products\Domain\Repository\ProductRepository;
use Helmich\ProductsApiAdvanced\Dto\ProductDto;
use Helmich\ProductsApiAdvanced\Mapper\ProductMapper;
use Helmich\ProductsApiAdvanced\Normalizer\Decorator\ManufacturerHypermediaDecorator;
use Helmich\ProductsApiAdvanced\Normalizer\Decorator\ProductHypermediaDecorator;
use Helmich\ProductsApiAdvanced\Normalizer\ManufacturerNormalizer;
use Helmich\ProductsApiAdvanced\Normalizer\ProductNormalizer;
use Helmich\RestTools\Mvc\Controller\RestController;
use Helmich\RestTools\Mvc\View\SerializingViewInterface;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\View\ViewInterface;

class ProductController extends RestController {

	/**
	 * @var ProductRepository
	 * @Flow\Inject
	 */
	protected $productRepository;

	/**
	 * @var ProductMapper
	 * @Flow\Inject
	 */
	protected $productMapper;

	public function initializeView(ViewInterface $view) {
		if ($view instanceof SerializingViewInterface) {
			$view->registerNormalizerForClass(Product::class, new ProductHypermediaDecorator(new ProductNormalizer(), $this->uriBuilder));
			$view->registerNormalizerForClass(Manufacturer::class, new ManufacturerHypermediaDecorator(new ManufacturerNormalizer(), FALSE, $this->uriBuilder));
		}
	}

	public function listAction() {
		$this->view->assign('products', $this->productRepository->findAll());
	}

	public function listByManufacturerAction(Manufacturer $manufacturer) {
		$this->view->assign('products', $this->productRepository->findByManufacturer($manufacturer));
	}

	public function initializeCreateAction() {
		$propertyMappingConfiguration = $this->arguments['product']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->allowAllProperties();
		$propertyMappingConfiguration->forProperty('manufacturer')->allowAllProperties();
	}

	public function showAction(Product $product) {
		$this->view->assign('product', $product);
	}

	public function createAction(ProductDto $product) {
		$realProduct = $this->productMapper->createProduct($product);
		$this->productRepository->add($realProduct);

		$this->view->assign('product', $realProduct);
		$this->response->setStatus(201);
	}

	public function initializeUpdateAction() {
		$propertyMappingConfiguration = $this->arguments['product']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->allowAllProperties();
		$propertyMappingConfiguration->skipUnknownProperties(TRUE);
		$propertyMappingConfiguration->forProperty('manufacturer')->allowAllProperties();
		$propertyMappingConfiguration->forProperty('manufacturer')->skipUnknownProperties();
	}

	/**
	 * @param string     $productIdentifier
	 * @param ProductDto $product
	 * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
	 */
	public function updateAction($productIdentifier, ProductDto $product) {
		$realProduct = $this->productMapper->updateProduct($productIdentifier, $product);
		$this->productRepository->update($realProduct);

		$this->view->assign('product', $realProduct);
	}

	public function deleteAction(Product $product) {
		$this->productRepository->remove($product);
		$this->view->assign('product', $product);
	}

}