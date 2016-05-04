<?php
namespace  Campus\Connect\Block\Adminhtml\Config\Edit\Tab;
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
    public $_model;
    public $_enitytypeattribute;
    
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Campus\Connect\Model\EnitytypeAttribute $EnitytypeAttribute,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_model = $this->_coreRegistry->registry('campusconnect_entitytype');
        $this->_enitytypeattribute=$EnitytypeAttribute;
        parent::__construct($context, $data);
    }
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
        if($this->_model->getId())
        return true;
        else
        return false;
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
    public function getEntityTypeRecord()
    {
        return $this->_model->getData();
    }
    public function getEntityAttributes()
    {
        $collection=$this->_enitytypeattribute->getCollection();
        $collection->addFieldToFilter("entity_type_id",$this->_model->getId());
        $data=array();
        if($collection->count()>0)
        {
            foreach($collection as $cd)
            {
               $data[]=$cd->getData(); 
            }
        }
        return $data;
    }
    public function getEntityType()
    {
        return $this->_model->getShortCode();
    }
    public function getEntityTypeId()
    {
        return $this->_model->getId();
    }
}
