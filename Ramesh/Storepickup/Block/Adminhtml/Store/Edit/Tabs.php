<?php
namespace Ramesh\Storepickup\Block\Adminhtml\Store\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_store_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Store Information'));
    }
}