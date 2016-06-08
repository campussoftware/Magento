<?php
namespace Ramesh\Connect\Block\Adminhtml\Erpconfig\Edit;
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('connect_rameshconnect_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('rameshconnect Information'));
    }
}
