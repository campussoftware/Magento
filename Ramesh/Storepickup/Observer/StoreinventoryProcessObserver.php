<?php
namespace Ramesh\Storepickup\Observer;

class StoreinventoryProcessObserver implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;
    protected $_resource;
    public $storeinventory;
    public $storeQuote;
   /**
     * Apply catalog price rules to product on frontend
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    function __construct(\Ramesh\Storepickup\Model\StoreInventoryFactory $storeinventory
            ,\Magento\Framework\Registry $registry
            , \Magento\Framework\App\ResourceConnection $resource
            , \Ramesh\Storepickup\Model\StoreQuoteFactory $storeQuote) 
    { 
        $this->storeinventory=$storeinventory;
        $this->_resource = $resource;
        $this->_coreRegistry = $registry;
        $this->storeQuote=$storeQuote;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order=$observer->getEvent()->getOrder();
        $orderId=$order->getId();
        $quoteId=$order->getQuoteId();
        $storeQuoteCollection=$this->storeQuote->create()->getCollection()->addFieldToFilter("quote_id",array("eq"=>$quoteId));
        if($storeQuoteCollection->count()>0)
        {
            foreach($storeQuoteCollection as $storeQuoteItemCollection)
            {
                if($storeQuoteItemCollection->getProcessInventory()!=1)
                {
                    $productId=$storeQuoteItemCollection->getProductId();
                    $storeId=$storeQuoteItemCollection->getStorepickupStoreId();
                    $storeinventoryCollection=$this->storeinventory->create()->getCollection()->addFieldToFilter("product_id",array("eq"=>$productId))->addFieldToFilter("storepickup_store_id",array("eq"=>$storeId));
                    foreach ($storeinventoryCollection as $tempstoreinventoryCollection)
                    {
                        $qty=$tempstoreinventoryCollection->getQty()-$storeQuoteItemCollection->getQty();
                        $tempstoreinventoryCollection->setQty($qty);
                        $tempstoreinventoryCollection->save();
                    }
                    $storeQuoteItemCollection->setProcessInventory("1");
                    $storeQuoteItemCollection->save();
                }
            }
        }
        else
        {
            $orderItems=$order->getAllItems();
            foreach($orderItems as $orderItem)
            {
                $productId=$orderItem->getProductId();
                $itemQty=$orderItem->getQtyOrdered();
               
                $storeinventoryCollection=$this->storeinventory->create()->getCollection()->addFieldToFilter("product_id",array("eq"=>$productId))->setOrder("sort_no");
                foreach ($storeinventoryCollection as $tempstoreinventoryCollection)
                {
                    if($itemQty>0)
                    {
                        $transactionQty=0;
                        $tempstoreinventoryQty=$tempstoreinventoryCollection->getQty();
                        if($tempstoreinventoryQty>$itemQty)
                        {
                            $transactionQty=$itemQty;
                        }
                        else
                        {
                            $transactionQty=$tempstoreinventoryQty;
                        }
                        $itemQty=$itemQty-$transactionQty;
                        
                        $finalStockQty=$tempstoreinventoryQty-$transactionQty;
                        
                        $storeid=$tempstoreinventoryCollection->getStorepickupStoreId();
                        $tempstoreinventoryCollection->setQty($finalStockQty);
                        $tempstoreinventoryCollection->save();
                        
                        $storeQuoteModel=$this->storeQuote->create();
                        $storeQuoteModel->setQuoteId($quoteId);
                        $storeQuoteModel->setProductId($productId);
                        $storeQuoteModel->setStorepickupStoreId($storeid);
                        $storeQuoteModel->setQty($transactionQty);
                        $storeQuoteModel->setProcessInventory(1);
                        $storeQuoteModel->save();
                    }                    
                    
                }
                
            }
        }        
    }
}
