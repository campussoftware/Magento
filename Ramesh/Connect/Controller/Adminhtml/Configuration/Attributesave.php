<?php
namespace Ramesh\Connect\Controller\Adminhtml\Configuration;
use Magento\Backend\App\Action;
class Attributesave extends \Magento\Backend\App\Action
{
 
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $_coreRegistry = null;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory ;    
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    
    protected $entitytypemodel;
    protected $_entitytypeAttributeModel;

    /**
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Ramesh\Connect\Model\EntitytypeFactory $entitytypemodel
     * @param \Ramesh\Connect\Model\EnitytypeAttributeFactory $entitytypeAttributeModel
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,            
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Ramesh\Connect\Model\EntitytypeFactory $entitytypemodel,
        \Ramesh\Connect\Model\EnitytypeAttributeFactory $entitytypeAttributeModel)
    {
        parent::__construct($context);
        
        $this->storeManager = $storeManager;
        $this->_date = $date;
        $this->resultPageFactory  = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->entitytypemodel=$entitytypemodel;
        $this->_entitytypeAttributeModel=$entitytypeAttributeModel;
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
       
        $attributeModel=$this->_entitytypeAttributeModel->create();
        if($data['attribute_id']!="")
        {
            $attributeModel->setId($data['attribute_id']);
        }
        $attributeModel->setEntityTypeId($data['parent_id']);
        $attributeModel->setMagentoAttributeId($data['magento_attribute_code']);
        $attributeModel->setAttributeName($data['attribute_name']);
        $attributeModel->setAttributeCode($data['attribute_short_code']);
        $attributeModel->setSortOrder($data['attribute_sort_order']);
        $attributeModel->setIsActive($data['attribute_is_active']);
        $attributeModel->save();        
        return "";
    }    
}
