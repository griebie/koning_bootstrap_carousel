<?php
namespace Keizer\KoningBootstrapCarousel\Controller;

/**
 * Controller: Carousel
 *
 * @package Keizer\KoningBootstrapCarousel\Controller
 */
class CarouselController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Keizer\KoningBootstrapCarousel\Domain\Repository\SlideRepository
     * @inject
     */
    protected $slideRepository;

    /**
     * Shows the carousel slides
     *
     * @return void
     */
    public function showAction()
    {
        $currentId = (int) $this->configurationManager->getContentObject()->getFieldVal('uid');

        if (!empty($this->settings['data']['template'])) {
            $this->view = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Fluid\View\StandaloneView::class);
            $this->view->setLayoutRootPath('EXT:koning_bootstrap_carousel/Resources/Private/Layouts/');
            $this->view->setTemplatePathAndFilename($this->settings['data']['template']);
        }

        $this->view->assignMultiple(array(
            'identifier' => 'koning-bootstrap-carousel-id-' . $currentId,
            'slides' => $this->slideRepository->findByContentId($currentId),
        ));
    }
}
