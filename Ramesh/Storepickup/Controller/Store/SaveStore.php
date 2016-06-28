<?php

namespace Ramesh\Storepickup\Controller\Store;

class SaveStore extends \Magento\Framework\App\Action\Action { 

    public $store;
    public $session;
    public $storeQuote;

    public function __construct(
    \Magento\Framework\App\Action\Context $context
    , \Ramesh\Storepickup\Model\Store $store
    , \Magento\Checkout\Model\Session $session
    , \Ramesh\Storepickup\Model\StoreQuoteFactory $storeQuote
    ) {
        $this->store = $store;
        $this->session=$session;
        $this->storeQuote=$storeQuote;
        parent::__construct($context);
    }

    public function execute() {
        
        $quoteId=$this->session->getQuote()->getId();
        $storeid=$this->getRequest()->getParam("storeid");
        $storeQuoteCollection=$this->storeQuote->create()->getCollection()->addFieldToFilter("quote_id",array("eq"=>$quoteId));
        if($storeQuoteCollection->count()>0)
        {
            foreach($storeQuoteCollection as $storeQuote)
            {
                $storeQuote->delete();
            }
        }       
        foreach ($this->session->getQuote()->getAllItems() as $item) 
        {
            $productid=$item->getProductId();
            $qty=$item->getQty();
            $storeQuoteModel=$this->storeQuote->create();
            $storeQuoteModel->setQuoteId($quoteId);
            $storeQuoteModel->setProductId($productid);
            $storeQuoteModel->setStorepickupStoreId($storeid);
            $storeQuoteModel->setQty($qty);
            $storeQuoteModel->setProcessInventory("0");
            $storeQuoteModel->save();
        }
        
        $jsonData = json_encode(array("quote_id"=>$quoteId,"storeid"=>$storeid));
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody($jsonData);
    }

}