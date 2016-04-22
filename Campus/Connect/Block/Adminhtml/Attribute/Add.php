<?php

namespace Campus\Connect\Block\Adminhtml\Attribute;

class Add extends \Magento\Backend\Block\Template
{
    public function __construct(\Magento\Backend\Block\Template\Context $context) 
    { 
        parent::__construct($context);
    }

    protected function _toHtml() 
    {
        return $this->_template;
    }
}
