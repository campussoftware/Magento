<?php
namespace Ramesh\Connect\Controller\Adminhtml\Erpconfig;
use Magento\Backend\App\Action;
class Save extends \Magento\Backend\App\Action
{
 
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    
    protected $erpmodel;


    /**
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Ramesh\Connect\Model\ErpFactory $erpmodel
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Ramesh\Connect\Model\ErpFactory $erpmodel)
    {
        parent::__construct($context);
        $this->storeManager = $storeManager;
        $this->_date = $date;
        $this->erpmodel=$erpmodel;
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        try
        {
        $entitytype=$this->erpmodel->create();   
        if($data['cn_erp_id'])
        {
            $entitytype->setId($data['cn_erp_id']);                
        }
        $entitytype->setName($data['name']);
        $entitytype->setShortCode($data['short_code']);
        $entitytype->setSortOrder($data['sort_order']);
        if(isset($data['is_active']))
        {
            $data['is_active']=1;
        }
        else
        {
            $data['is_active']=0;
        }
        $entitytype->setIsActive($data['is_active']);
        $entitytype->save();
        
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
            die;
        }
        
        $this->_getSession()->setFormData($data);
        $this->_redirect('*/*/');
        
    }
}
