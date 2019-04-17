<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Controller\Adminhtml\Tab;

use Bunited\CustomTabs\Model\ResourceModel\Tab\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 * @package Bunited\CustomTabs\Controller\Adminhtml\Tab
 */
class MassDelete extends Action
{
    /**
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;

        foreach ($collection->getItems() as $record) {
            $record->setId($record->getEntityId());
            $record->delete();
            $recordDeleted++;
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $recordDeleted));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    /**
     * Check Permission.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bunited_CustomTabs::row_data_delete');
    }
}