<?php
namespace Campus\Connect\Model\ResourceModel\EnitytypeAttribute;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Campus\Connect\Model\EnitytypeAttribute', 'Campus\Connect\Model\ResourceModel\EnitytypeAttribute');
    }
}