<?php
namespace Helmich\ProductsApiSimple\Controller;


use Helmich\Products\Domain\Model\Manufacturer;
use Helmich\Products\Domain\Repository\ManufacturerRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Mvc\View\JsonView;
use TYPO3\Flow\Mvc\View\ViewInterface;

class ManufacturerController extends ActionController {

	protected $supportedMediaTypes = ['application/json'];

	protected $viewFormatToObjectNameMap = ['json' => JsonView::class];

	/**
	 * @var ManufacturerRepository
	 * @Flow\Inject
	 */
	protected $manufacturerRepository;

	protected function initializeView(ViewInterface $view) {
		if ($view instanceof JsonView) {
			$manufacturerConfiguration = [
				'_exposeObjectIdentifier'     => TRUE,
				'_exposedObjectIdentifierKey' => 'identifier'
			];
			$view->setConfiguration([
				'value' => [
					'manufacturers' => ['_descendAll' => $manufacturerConfiguration],
					'manufacturer'  => $manufacturerConfiguration
				]
			]);
		}
	}

	public function listAction() {
		$manufacturers = $this->manufacturerRepository->findAll();
		$this->view->assign('value', ['manufacturers' => $manufacturers]);
	}

	public function showAction(Manufacturer $manufacturer) {
		$this->view->assign('value', ['manufacturer' => $manufacturer]);
	}
}