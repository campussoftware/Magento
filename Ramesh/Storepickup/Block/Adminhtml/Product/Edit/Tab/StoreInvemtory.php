<?php

namespace Ramesh\Storepickup\Block\Adminhtml\Product\Edit\Tab;

class StoreInvemtory extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var string
     */
    protected $_template = 'storeinvemtory.phtml';
    /**
     * Reference to product objects that is being edited
     *
     * @var \Magento\Catalog\Model\Product
     */
    protected $_product = null;

    /**
     * @var \Magento\Framework\DataObject|null
     */
    protected $_config = null;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;
    
    public $storeModel;
    
    public $storeinventory;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Ramesh\Storepickup\Model\Store $storeModel,
        \Ramesh\Storepickup\Model\StoreInventory $storeinventory,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_formFactory = $formFactory;  
        $this->storeModel=$storeModel;
        $this->storeinventory=$storeinventory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Check is readonly block
     *
     * @return boolean
     */
    public function isReadonly()
    {
        return false;
    }

    /**
     * Retrieve product
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        return $this->_coreRegistry->registry('current_product');
    }

    /**
     * Get tab label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Store Inventory Information');
    }

    /**
     * Get tab title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Store Inventory Information');
    }

    /**
     * Check if tab can be displayed
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Check if tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Get downloadable tab content id
     *
     * @return string
     */
    /*public function getContentTabId()
    {
        return 'tab_content_prices';
    }*/

    /**
     * @return Form
     */
    protected function _prepareForm()
    {        
        return parent::_prepareForm();
    }
    public function getStoreDetails()
    {
        $data=$this->storeModel->getCollection()->addFieldToSelect("name")->addFieldToSelect("id")->getData();
        return $data;
    }
    public function getStoreInventoryDetails()
    {
        $productId=$this->getProduct()->getId();
        $collection=$this->storeinventory->getCollection()->addFieldToFilter("product_id",array("eq"=>$productId));        
        $data=$collection->getData();
        return $data;
    }
    
}