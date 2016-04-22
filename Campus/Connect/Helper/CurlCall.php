<?php

namespace Campus\Connect\Helper;

class CurlCall extends \Magento\Framework\App\Helper\AbstractHelper {
    protected $_url;
    protected $_headers=array();
    protected $_postfields;
    protected $_headers=array();
    
    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        parent::__construct($context);
    }

}
