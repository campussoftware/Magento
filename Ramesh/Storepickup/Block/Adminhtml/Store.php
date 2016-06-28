<?php
namespace Ramesh\Storepickup\Block\Adminhtml;
class Store extends \Magento\Backend\Block\Widget\Grid\Container
{
    
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_store';/*block grid.php directory*/
        $this->_blockGroup = 'Ramesh_Storepickup';
        $this->_headerText = __('Store');
        $this->_addButtonLabel = __('Add Store'); 
        parent::_construct();
        $this->addButton('SyncInventory', array(
        'label'   =>__('Sync Existing Inventory To Default Store'),
        'onclick' => "setLocation('{$this->getUrl('*/*/SyncInventory')}')",
        'class'   => 'SyncInventory',
        'style'=>'border: 1px solid brown;
    background: beige;'
    ));
       
    }
    
}