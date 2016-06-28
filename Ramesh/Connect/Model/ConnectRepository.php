<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ramesh\Connect\Model;


class ConnectRepository implements \Ramesh\Connect\Api\ConnectRepositoryInterface
{
    public $entityAttrbutes;
    function __construct(\Ramesh\Connect\Model\EnitytypeAttribute $entityAttrbutes) 
    {
        $this->entityAttrbutes=$entityAttrbutes;
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function getCustomerStructure($erpcode)
    {
        $data=$this->entityAttrbutes->getCollection()->addFieldToSelect("attribute_code")->addFieldToSelect("attribute_name")->addFieldToFilter("is_active",array("eq"=>1))->addOrder("sort_order", "ASC")->getData();
        $responseData=array();
        if(count($data)>0)
        {
            foreach($data as $attributeData)
            {
                $responseData[$attributeData['attribute_code']]['value']="";
                $responseData[$attributeData['attribute_code']]['label']=$attributeData['attribute_name'];
            }
        }
        return json_encode($responseData);
    }

    
}
