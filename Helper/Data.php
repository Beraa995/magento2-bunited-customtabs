<?php
/**
 * @category  Bunited
 * @package   Bunited\CustomTabs
 * @author    Berin Kozlic - beringgmu@gmail.com
 * @copyright 2019 Berin Kozlic
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bunited\CustomTabs\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Custom Tabs Data Helper
 */
class Data extends AbstractHelper
{
    /**
     * Helper constants
     */
    const XML_PATH_ENABLED = 'custom_tab_general/general/enabled';
    const XML_PATH_HIDE_DETAILS = 'custom_tab_general/default_tabs/details';
    const XML_PATH_HIDE_DETAILS_SORT = 'custom_tab_general/default_tabs_sort/details_sort';
    const XML_PATH_HIDE_MORE = 'custom_tab_general/default_tabs/more';
    const XML_PATH_HIDE_MORE_SORT = 'custom_tab_general/default_tabs_sort/more_sort';
    const XML_PATH_HIDE_REVIEWS = 'custom_tab_general/default_tabs/review';
    const XML_PATH_HIDE_REVIEWS_SORT = 'custom_tab_general/default_tabs_sort/review_sort';

    /**
     * Extension config
     *
     * @var ScopeConfigInterface
     */
    protected $config;

    /**
     * @param Context              $context
     * @param ScopeConfigInterface $config
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $config
    ) {
        $this->config = $config;
        parent::__construct($context);
    }

    /**
     * Check if extension is enabled
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->config->getValue(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if details tab is hidden
     *
     * @return boolean
     */
    public function hideDetails()
    {
        return $this->config->getValue(self::XML_PATH_HIDE_DETAILS, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get details tab sort
     *
     * @return boolean
     */
    public function getSortDetails()
    {
        return $this->config->getValue(self::XML_PATH_HIDE_DETAILS_SORT, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if more information tab is hidden
     *
     * @return boolean
     */
    public function hideMoreInfo()
    {
        return $this->config->getValue(self::XML_PATH_HIDE_MORE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get more information tab sort
     *
     * @return boolean
     */
    public function getSortMoreInfo()
    {
        return $this->config->getValue(self::XML_PATH_HIDE_MORE_SORT, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if reviews tab is hidden
     *
     * @return boolean
     */
    public function hideReviews()
    {
        return $this->config->getValue(self::XML_PATH_HIDE_REVIEWS, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get reviews tab sort
     *
     * @return boolean
     */
    public function getSortReviews()
    {
        return $this->config->getValue(self::XML_PATH_HIDE_REVIEWS_SORT, ScopeInterface::SCOPE_STORE);
    }
}