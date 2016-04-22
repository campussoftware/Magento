<?php
namespace Campus\Connect\Model\ResourceModel\Entitytype;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Campus\Connect\Model\Entitytype', 'Campus\Connect\Model\ResourceModel\Entitytype');
    }
}