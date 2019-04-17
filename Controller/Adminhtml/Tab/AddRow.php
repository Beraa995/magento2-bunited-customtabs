<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Controller\Adminhtml\Tab;

use Bunited\CustomTabs\Model\TabFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;

/**
 * Class AddRow
 * @package Bunited\CustomTabs\Controller\Adminhtml\Tab
 */
class AddRow extends Action
{
    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @var TabFactory
     */
    private $gridFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry,
     * @param TabFactory $gridFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        TabFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
    }

    /**
     * Mapped Grid List page.
     * @return Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->gridFactory->create();

        /** @var Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('tab/tab/rowdata');

                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ') . $rowTitle : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }

    /**
     * Check permission for passed action.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bunited_CustomTabs::add_row');
    }
}
