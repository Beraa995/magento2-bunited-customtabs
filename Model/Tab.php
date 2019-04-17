<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Model;

use Bunited\CustomTabs\Api\Data\TabInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Tab
 * @package Bunited\CustomTabs\Model
 */
class Tab extends AbstractModel implements TabInterface
{
    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Bunited\CustomTabs\Model\ResourceModel\Tab');
    }

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get Title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title.
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get Title.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->getData(self::TAB_CLASS);
    }

    /**
     * Set Title.
     */
    public function setClass($class)
    {
        return $this->setData(self::TAB_CLASS, $class);
    }

    /**
     * Get getContent.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set Content.
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get IsActive.
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set IsActive.
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get TabSort.
     *
     * @return string
     */
    public function getTabSort()
    {
        return $this->getData(self::TAB_SORT);
    }

    /**
     * Set TabSort.
     */
    public function setTabSort($tabSort)
    {
        return $this->setData(self::TAB_SORT, $tabSort);
    }
}
