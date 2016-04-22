<?php
namespace Campus\Connect\Block\Adminhtml\Config\Edit;
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('connect_campusconnect_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Campusconnect Information'));
    }
}
