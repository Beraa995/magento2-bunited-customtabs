<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class TabHide
 * @package Bunited\CustomTabs\Model\Config\Source
 */
class TabHide implements ArrayInterface
{
    /**
     * Return option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('No')],
            ['value' => 'all', 'label' => __('Hide All')],
            ['value' => 'custom', 'label' => __('Custom')]
        ];
    }
}
