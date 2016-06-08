<?php
namespace Ramesh\Connect\Model\ResourceModel\Entitytype;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Ramesh\Connect\Model\Entitytype', 'Ramesh\Connect\Model\ResourceModel\Entitytype');
    }
}