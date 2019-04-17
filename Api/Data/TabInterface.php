<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Api\Data;

/**
 * Interface TabInterface
 * @package Bunited\CustomTabs\Api\Data
 */
interface TabInterface
{
    /**
     * Constants.
     */
    const ENTITY_ID = 'entity_id';
    const TITLE = 'title';
    const TAB_CLASS = 'class';
    const CONTENT = 'content';
    const IS_ACTIVE = 'is_active';
    const TAB_SORT = 'tab_sort';

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId();

    /**
     * Set EntityId.
     * @param $entityId
     */
    public function setEntityId($entityId);

    /**
     * Get Title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set Title.
     * @param $title
     */
    public function setTitle($title);

    /**
     * Get Class.
     *
     * @return string
     */
    public function getClass();

    /**
     * Set Class.
     * @param $class
     */
    public function setClass($class);

    /**
     * Get Content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Set Content.
     * @param $content
     */
    public function setContent($content);

    /**
     * Get IsActive.
     *
     * @return int
     */
    public function getIsActive();

    /**
     * Set IsActive.
     * @param $isActive
     */
    public function setIsActive($isActive);

    /**
     * Get TabSort.
     *
     * @return int
     */
    public function getTabSort();

    /**
     * Set TabSort.
     * @param $tabSort
     */
    public function setTabSort($tabSort);
}
