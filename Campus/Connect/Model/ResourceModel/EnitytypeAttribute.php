<?php

namespace Campus\Connect\Model\ResourceModel;
class EnitytypeAttribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    //put your code here
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('cn_entity_type_attributes', 'attribute_id');
    }
}
