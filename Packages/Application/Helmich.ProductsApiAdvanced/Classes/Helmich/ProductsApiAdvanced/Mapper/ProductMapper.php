<?php
namespace Helmich\ProductsApiAdvanced\Mapper;

use Helmich\Products\Domain\Model\Product;
use Helmich\Products\Domain\Repository\ManufacturerRepository;
use Helmich\Products\Domain\Repository\ProductRepository;
use Helmich\ProductsApiAdvanced\Dto\ProductDto;
use TYPO3\Flow\Annotations as Flow;

/**
 * @package    Helmich\ProductsApiAdvanced
 * @subpackage Mapper
 *
 * @Flow\Scope("singleton")
 */
class ProductMapper {

	/**
	 * @var ManufacturerRepository
	 * @Flow\Inject
	 */
	protected $manufacturerRepository;

	/**
	 * @var ProductRepository
	 * @Flow\Inject
	 */
	protected $productRepository;

	public function createProduct(ProductDto $productDto) {
		$manufacturer = $this->manufacturerRepository->findByIdentifier($productDto->getManufacturer()->getIdentifier());
		$product      = new Product(
			$productDto->getName(),
			$productDto->getPrice(),
			$manufacturer,
			$productDto->getQuantity()
		);
		return $product;
	}

	public function updateProduct($identifier, ProductDto $productDto) {
		/** @var Product $product */
		$product      = $this->productRepository->findByIdentifier($identifier);
		$manufacturer = $this->manufacturerRepository->findByIdentifier($productDto->getManufacturer()->getIdentifier());

		if (NULL === $product) {
			throw new \InvalidArgumentException('Product does not exist!');
		}

		$product->setName($productDto->getName());
		$product->setPrice($productDto->getPrice());
		$product->setQuantity($productDto->getQuantity());
		$product->setManufacturer($manufacturer);

		return $product;
	}

}