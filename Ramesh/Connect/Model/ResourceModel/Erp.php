<?php

namespace Ramesh\Connect\Model\ResourceModel;
class Erp extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    //put your code here
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('cn_erp', 'cn_erp_id');
    }
}
