<?php
namespace Ramesh\Storepickup\Observer;

class StoreinventoryObserver implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;
    protected $_resource;
    public $productModel;
    public $storeinventory;
   /**
     * Apply catalog price rules to product on frontend
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    function __construct(\Ramesh\Storepickup\Model\StoreInventoryFactory $storeinventory
            ,\Magento\Catalog\Model\Product $productModel
            ,\Magento\Framework\Registry $registry
            , \Magento\Framework\App\ResourceConnection $resource) 
    { 
        $this->storeinventory=$storeinventory;
        $this->productModel=$productModel;
        $this->_resource = $resource;
        $this->_coreRegistry = $registry;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if(isset($_REQUEST['product']))
        {
            $productdata=$_REQUEST['product'];
            if(isset($productdata['existinginventorycount']))
            {                
                $qty=0;
                $prdouct=$this->_coreRegistry->registry('current_product');
                $productId=$prdouct->getId();
                $storeinventory=$this->storeinventory->create();
                $collections=$storeinventory->getCollection()->addFieldToFilter("product_id",array("eq"=>$productId));
                if($collections->count()>0)
                {
                    foreach($collections as $collection)
                    {
                        $collection->delete();
                    }
                }                
                $storeinventory=isset($productdata['storeinventory'])?$productdata['storeinventory']:array();
                if(count($storeinventory)>0)
                {
                    foreach ($storeinventory as $storeInventoryData)
                    {
                        $storeinventory=$this->storeinventory->create();
                        $storeinventory->setStorepickupStoreId($storeInventoryData['store_id']);
                        $storeinventory->setProductId($productId);
                        $storeinventory->setQty($storeInventoryData['qty']);
                        $storeinventory->save();
                        $qty+=$storeInventoryData['qty'];
                    }
                }    
                $connection = $this->_resource->getConnection();
                $table = $this->_resource->getTableName('cataloginventory_stock_item');
                $sql = "update " . $table . " set qty='".$qty."' where product_id='" . $productId . "' ;";
                $connection->query($sql);
            }
        }        
        return $this;
    }
}
