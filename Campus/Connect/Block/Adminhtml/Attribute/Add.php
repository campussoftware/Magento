<?php

namespace Campus\Connect\Block\Adminhtml\Attribute;

class Add extends \Magento\Backend\Block\Template
{
    protected $_attributeModel;
    protected $request;
    /**
     * 
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Eav\Model\Entity\Attribute $attributeModel
     * @param \Campus\Connect\Model\EntitytypeFactory $entitytypemodel
     * @param \Campus\Connect\Model\EnitytypeAttributeFactory $entitytypeAttributeModel
     */
    public function __construct(\Magento\Backend\Block\Template\Context $context
            ,\Magento\Framework\App\Request\Http $request
            ,\Magento\Eav\Model\Entity\Attribute $attributeModel
            ,\Campus\Connect\Model\EntitytypeFactory $entitytypemodel
            ,\Campus\Connect\Model\EnitytypeAttributeFactory $entitytypeAttributeModel) 
    { 
        $this->_attributeModel=$attributeModel;
        $this->request = $request;
        $this->entitytypemodel=$entitytypemodel;
        $this->_entitytypeAttributeModel=$entitytypeAttributeModel;
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
    public function getExistingRecord()
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
}
