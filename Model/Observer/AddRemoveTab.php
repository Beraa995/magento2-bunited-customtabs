<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Model\Observer;

use Bunited\CustomTabs\Helper\Data;
use Bunited\CustomTabs\Model\ResourceModel\Tab\CollectionFactory as TabFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Layout;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class AddRemoveTab
 * @package Bunited\CustomTabs\Model\Observer
 */
class AddRemoveTab implements ObserverInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected $config;

    /**
     * @var TabFactory
     */
    protected $tabCollection;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param ScopeConfigInterface $config
     * @param TabFactory $tabCollection,
     * @param FilterProvider $filterProvider
     * @param StoreManagerInterface $storeManager
     * @param Data $helper
     */
    public function __construct(
        ScopeConfigInterface $config,
        TabFactory $tabCollection,
        FilterProvider $filterProvider,
        StoreManagerInterface $storeManager,
        Data $helper
    ) {
        $this->config = $config;
        $this->tabCollection = $tabCollection;
        $this->filterProvider = $filterProvider;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

    /**
     * Remove blocks depending on backend configuration
     *
     * @param $observer
     * @throws NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        /** @var Layout $layout */
        $layout = $observer->getLayout();
        $handle = $layout->getUpdate()->getHandles();

        if ($this->helper->isEnabled() && in_array('catalog_product_view', $handle)) {
            $this->customizeDefaultTabs($layout);
            $this->addTabs($layout);
        }
    }

    /**
     * Customize default tabs on product page
     *
     * @param $layout
     */
    protected function customizeDefaultTabs($layout)
    {
        $details = $layout->getBlock('product.info.description');
        $review = $layout->getBlock('reviews.tab');
        $moreInfo = $layout->getBlock('product.attributes');

        if ($details) {
            if ($this->helper->hideDetails()) {
                $layout->unsetElement('product.info.description');
            } else {
                $details->setSortOrder($this->helper->getSortDetails());
            }
        }

        if ($review) {
            if ($this->helper->hideReviews()) {
                $layout->unsetElement('reviews.tab');
            } else {
                $review->setSortOrder($this->helper->getSortReviews());
            }
        }

        if ($moreInfo) {
            if ($this->helper->hideMoreInfo()) {
                $layout->unsetElement('product.attributes');
            } else {
                $moreInfo->setSortOrder($this->helper->getSortMoreInfo());
            }
        }
    }

    /**
     * Add tabs to layout
     *
     * @param $layout
     * @throws NoSuchEntityException
     */
    protected function addTabs($layout)
    {
        $tabWrapper = $layout->getBlock('product.info.details');
        $storeId = $this->storeManager->getStore()->getId();

        if ($tabWrapper) {
            $tabCollection = $this->tabCollection->create()->addFieldToFilter('is_active', ['eq' => 1]);

            foreach ($tabCollection as $tab) {
                $layout->addBlock(Template::class, 'tab' . $tab->getId(), 'product.info.details');
                $layout->getBlock('tab' . $tab->getId())->setTemplate('Bunited_CustomTabs::renderer.phtml')
                    ->setTitle($tab->getTitle())
                    ->setClass($tab->getClass())
                    ->setSortOrder($tab->getTabSort())
                    ->setContent($this->filterProvider->getBlockFilter()->setStoreId($storeId)->filter($tab->getContent()));
                $layout->addToParentGroup('tab' . $tab->getId(), 'detailed_info');
            }
        }
    }
}
