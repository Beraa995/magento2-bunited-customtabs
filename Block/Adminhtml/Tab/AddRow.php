<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Block\Adminhtml\Tab;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

/**
 * Class AddRow
 * @package Bunited\CustomTabs\Block\Adminhtml\Tab
 */
class AddRow extends Container
{
    /**
     * Core registry.
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Tabs Edit Block.
     */
    protected function _construct()
    {
        $this->_objectId = 'row_id';
        $this->_blockGroup = 'Bunited_CustomTabs';
        $this->_controller = 'adminhtml_tab';

        parent::_construct();

        if ($this->_isAllowedAction('Bunited_CustomTabs::add_row')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }

        $this->buttonList->remove('reset');
    }

    /**
     * Retrieve text for header element.
     *
     * @return Phrase
     */
    public function getHeaderText()
    {
        return __('Add RoW Data');
    }

    /**
     * Check permission for passed action.
     *
     * @param string $resourceId
     *
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }

        return $this->getUrl('*/*/save');
    }
}
