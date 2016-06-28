<?php

namespace Ramesh\Connect\Block\Adminhtml\Attribute;

class Add extends \Magento\Backend\Block\Template
{
    protected $_attributeModel;
    protected $_resource;
    protected $request;
    /**
     * 
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Eav\Model\Entity\Attribute $attributeModel
     * @param \Ramesh\Connect\Model\EntitytypeFactory $entitytypemodel
     * @param \Ramesh\Connect\Model\EnitytypeAttributeFactory $entitytypeAttributeModel
     */
    public function __construct(\Magento\Backend\Block\Template\Context $context
            ,\Magento\Framework\App\Request\Http $request
            ,\Magento\Eav\Model\Entity\Attribute $attributeModel
            ,\Ramesh\Connect\Model\EntitytypeFactory $entitytypemodel
            ,\Ramesh\Connect\Model\EnitytypeAttributeFactory $entitytypeAttributeModel
            ,\Magento\Framework\App\ResourceConnection $resource) 
    { 
        $this->_attributeModel=$attributeModel;
        $this->request = $request;
        $this->entitytypemodel=$entitytypemodel;
        $this->_entitytypeAttributeModel=$entitytypeAttributeModel;
        $this->_resource = $resource;
        parent::__construct($context);
    }
    public function getAttributeList()
    {
        $attributeData=array();
        $entityTypeId=$this->getEntityTypeId();
        $entityTypeData=$this->entitytypemodel->create()->load($entityTypeId);
        $collection=$this->_attributeModel
                ->getCollection()
                ->addFieldToFilter("entity_type_id",$entityTypeData->getMagentoEntityId())
                ->setOrder('frontend_label','ASC');
        $data=array();
        $data['code']="magentoid";
        $data['label']="Magento Id";
        $attributeData[]=$data;
        if($collection->count()>0)
        {
            
            foreach($collection as $collectionData)
            {
                $data=array();
                $data['code']=$collectionData->getAttributeCode();
                $data['label']=$collectionData->getFrontendLabel();
                $attributeData[]=$data;
            }
        }
        return $attributeData;
    }
    public function getEntityTypeId()
    {
        return $this->request->getParam('entity_type_id');        
    }
    public function getAttributeId()
    {
        return $this->request->getParam('attribute_id');        
    }
    public function getExistingAttributeData()
    {
        $attributeId=$this->getAttributeId();
        if($attributeId)
        {
            $attributeModel=$this->_entitytypeAttributeModel->create()->load($attributeId);
            return $attributeModel->getData();
        }
        else
        {
            return array();
        }
    }
    public function getEntityList()
    {
        $entityTypes=array();
        $connection=$this->_resource->getConnection();
        $entityTable = $this->_resource->getTableName('cn_entity_type');
        $sql = "select * FROM " . $entityTable . ";";
        $result=$connection->fetchAll($sql);
        if(count($result)>0)
        {
            foreach($result as $rs)
            {
                $entityTypes[]=$rs;
            }
        }
        return $entityTypes;
    }
}
