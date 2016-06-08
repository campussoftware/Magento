<?php
namespace Ramesh\Connect\Model\ResourceModel\Erp;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Ramesh\Connect\Model\Erp', 'Ramesh\Connect\Model\ResourceModel\Erp');
    }
}