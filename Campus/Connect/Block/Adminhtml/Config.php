<?php
namespace Campus\Connect\Block\Adminhtml;
class Config extends \Magento\Backend\Block\Widget\Grid\Container
{
    //put your code here
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_Config';/*block grid.php directory*/
        $this->_blockGroup = 'Campus_Connect';
        $this->_headerText = __('Campusconnect');
        $this->_addButtonLabel = __('Add New Entry'); 
        parent::_construct();
		
    }
}
