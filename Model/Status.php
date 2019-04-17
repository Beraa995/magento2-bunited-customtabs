<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Model;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 * @package Bunited\CustomTabs\Model
 */
class Status implements OptionSourceInterface
{
    /**
     * Get Grid row status type labels array.
     * @return array
     */
    public function getOptionArray()
    {
        $options = ['1' => __('Enabled'),'0' => __('Disabled')];
        return $options;
    }

    /**
     * Get Grid row status labels array with empty value for option element.
     *
     * @return array
     */
    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);
        return $res;
    }

    /**
     * Get Grid row type array for option element.
     * @return array
     */
    public function getOptions()
    {
        $res = [];

        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }

        return $res;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getOptions();
    }
}