<?php

namespace Ramesh\Connect\Model\ResourceModel;
class Entitytype extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    //put your code here
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('cn_entity_type', 'entity_type_id');
    }
}
