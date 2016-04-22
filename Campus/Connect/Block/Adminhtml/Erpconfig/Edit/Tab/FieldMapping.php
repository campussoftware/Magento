<?php
namespace  Campus\Connect\Block\Adminhtml\Erpconfig\Edit\Tab;
use Magento\Backend\Block\Widget\Tab\TabInterface;
class FieldMapping extends \Magento\Backend\Block\Widget implements TabInterface
{
    //put your code here
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
   

    /**
     * Prepare content for tab
     *
     * @return \Magento\Framework\Phrase
     * @codeCoverageIgnore
     */
    public function getTabLabel()
    {
        return __('Field Mapping');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     * @codeCoverageIgnore
     */
    public function getTabTitle()
    {
        return __('Field Mapping');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return bool
     * @codeCoverageIgnore
     */
    public function canShowTab()
    {
        
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return bool
     * @codeCoverageIgnore
     */
    public function isHidden()
    {
        return false;
    }
}
