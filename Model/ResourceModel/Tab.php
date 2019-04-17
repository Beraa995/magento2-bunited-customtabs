<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Tab
 * @package Bunited\CustomTabs\Model\ResourceModel
 */
class Tab extends AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('bunited_tabs', 'entity_id');
    }
}