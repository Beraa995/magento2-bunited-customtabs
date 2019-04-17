<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Model\ResourceModel\Tab;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Bunited\CustomTabs\Model\ResourceModel\Tab
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Bunited\CustomTabs\Model\Tab', 'Bunited\CustomTabs\Model\ResourceModel\Tab');
    }
}