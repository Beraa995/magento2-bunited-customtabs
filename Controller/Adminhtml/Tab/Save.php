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

/**
 * Class Save
 * @package Bunited\CustomTabs\Controller\Adminhtml\Tab
 */
class Save extends Action
{
    /**
     * @var TabFactory
     */
    protected $gridFactory;

    /**
     * @param Context    $context
     * @param TabFactory $gridFactory
     */
    public function __construct(
        Context $context,
        TabFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
    }

    /**
     * Return redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('tab/tab/addrow');

            return;
        }

        try {
            $rowData = $this->gridFactory->create();
            $rowData->setData($data);

            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }

            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }

        $this->_redirect('tab/tab/index');
    }

    /**
     * Check Permission
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bunited_CustomTabs::save');
    }
}
