<?php
namespace Helmich\ProductsApiAdvanced\Controller;

use Helmich\Products\Domain\Model\Manufacturer;
use Helmich\Products\Domain\Model\Product;
use Helmich\Products\Domain\Repository\ManufacturerRepository;
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

class ManufacturerController extends RestController {

	/**
	 * @var ManufacturerRepository
	 * @Flow\Inject
	 */
	protected $manufacturerRepository;

	public function initializeView(ViewInterface $view) {
		if ($view instanceof SerializingViewInterface) {
			$view->registerNormalizerForClass(Manufacturer::class, new ManufacturerHypermediaDecorator(new ManufacturerNormalizer(), TRUE, $this->uriBuilder));
		}
	}

	public function listAction() {
		$this->view->assign('manufacturers', $this->manufacturerRepository->findAll());
	}

	public function showAction(Manufacturer $manufacturer) {
		$this->view->assign('manufacturer', $manufacturer);
	}

}