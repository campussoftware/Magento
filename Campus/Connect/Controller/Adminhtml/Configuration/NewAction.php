<?php

namespace Campus\Connect\Controller\Adminhtml\Configuration;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class NewAction extends \Magento\Backend\App\Action {

    public function execute() {
        $this->_forward('edit');
    }

}
