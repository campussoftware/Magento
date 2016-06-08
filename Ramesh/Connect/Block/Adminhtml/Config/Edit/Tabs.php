<?php
namespace Ramesh\Connect\Block\Adminhtml\Config\Edit;
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        
        $this->setId('connect_entityconfig_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('rameshconnect Information'));
        parent::_construct();
    }
}
