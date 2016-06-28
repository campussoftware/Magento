<?php
namespace Ramesh\Storepickup\Controller\Adminhtml\Store;

class SyncInventory extends \Magento\Backend\App\Action {
        
    protected $_resource;
    public $storeModel;    
    public $storeinventory;

    
    public function __construct(
    \Ramesh\Storepickup\Model\StoreInventoryFactory $storeinventory
    , \Magento\Backend\App\Action\Context $context
    , \Magento\Framework\App\ResourceConnection $resource
    , \Ramesh\Storepickup\Model\StoreFactory $storeModel) {
        parent::__construct($context);
        $this->storeModel = $storeModel;
        $this->_resource = $resource;
        $this->storeinventory=$storeinventory;
    }
    //put your code here
    public function execute()
    {
        $connection = $this->_resource->getConnection();
        $storeData=$this->storeModel->create()->getCollection()->addFieldToSelect("id")->addFieldToFilter("is_default",array("eq"=>1))->getData();
        if(count($storeData)>0)
        {
            $storeId=$storeData['0']['id'];
            $table = $this->_resource->getTableName('cataloginventory_stock_item');
            $sql = "select product_id,qty from " . $table . " ;";
            $result=$connection->fetchAll($sql);
            if(count($result)>0)
            {
                foreach($result as $rs)
                {
                    $productId=$rs['product_id'];
                    $qty=$rs['qty'];
                    $storeinventory=$this->storeinventory->create();
                    $collections=$storeinventory->getCollection()->addFieldToFilter("product_id",array("eq"=>$productId));
                    if($collections->count()==0)
                    {
                        
                        $storeinventory=$this->storeinventory->create();
                        $storeinventory=$this->storeinventory->create();
                        $storeinventory->setStorepickupStoreId($storeId);
                        $storeinventory->setProductId($productId);
                        $storeinventory->setQty($qty);
                        $storeinventory->save();
                    }                    
                }
            }
        }
        $this->_redirect('*/*/');
               
    }
}
