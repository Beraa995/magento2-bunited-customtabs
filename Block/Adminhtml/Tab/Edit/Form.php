<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Block\Adminhtml\Tab\Edit;

use Bunited\CustomTabs\Model\Status;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;

/**
 * Class Form
 * @package Bunited\CustomTabs\Block\Adminhtml\Tab\Edit
 */
class Form extends Generic
{
    /**
     * @var Config
     */
    protected $wysiwygConfig;

    /**
     * @var Status
     */
    protected $options;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $options
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $options,
        array $data = []
    ) {
        $this->options = $options;
        $this->wysiwygConfig = $wysiwygConfig;

        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     * @return Generic
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );

        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'id' => 'title',
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'class',
            'text',
            [
                'name' => 'class',
                'label' => __('Tab Class Name'),
                'id' => 'class',
                'title' => __('Tab Class Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'tab_sort',
            'text',
            [
                'name' => 'tab_sort',
                'label' => __('Tab Sort Number'),
                'id' => 'tab_sort',
                'title' => __('Tab Sort Number'),
                'class' => 'required-entry',
                'note'  => 'Sort numbers of magento default tabs are 10,20,30',
                'required' => true
            ]
        );

        $wysiwygConfig = $this->wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'style' => 'height:36em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Status'),
                'id' => 'is_active',
                'title' => __('Status'),
                'values' => $this->options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
