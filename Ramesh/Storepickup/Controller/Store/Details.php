<?php

namespace Ramesh\Storepickup\Controller\Store;

class Details extends \Magento\Framework\App\Action\Action { 

    public $store;

    public function __construct(
    \Magento\Framework\App\Action\Context $context, \Ramesh\Storepickup\Model\Store $store
    ) {
        $this->store = $store;
        parent::__construct($context);
    }

    public function execute() {
        $storeDetails = $this->store->getCollection()->setOrder("sort_no")->getData();
        $jsonData = json_encode(array('result' => $storeDetails, "requesteddata" => $this->getRequest()->getParams()));
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody($jsonData);
    }

}
