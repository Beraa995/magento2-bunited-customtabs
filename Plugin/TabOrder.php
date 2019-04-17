<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Plugin;

use Bunited\CustomTabs\Helper\Data;
use Magento\Catalog\Block\Product\View\Details;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class TabOrder
 * @package Bunited\CustomTabs\Plugin
 */
class TabOrder
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Order tabs
     * @param Details $subject
     * @param $groupName
     * @param $callback
     * @throws LocalizedException
     */
    public function beforeGetGroupSortedChildNames(Details $subject, $groupName, $callback)
    {
        if ($this->helper->isEnabled()) {
            $groupChildNames = $subject->getGroupChildNames($groupName, $callback);
            $layout = $subject->getLayout();

            $childNamesSortOrder = [];

            foreach ($groupChildNames as $childName) {
                $alias = $layout->getElementAlias($childName);
                $sortOrder = $subject->getChildData($alias, 'sort_order');

                $childNamesSortOrder[$alias] = $sortOrder;
            }

            asort($childNamesSortOrder);
            $iteration = 1;

            foreach ($childNamesSortOrder as $alias => $sort) {
                $subject->getChildBlock($alias)->setData('sort_order', $iteration);
                $iteration++;
            }
        }
    }
}