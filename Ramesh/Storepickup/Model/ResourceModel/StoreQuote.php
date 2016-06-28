<?php
/**
 * Copyright © 2015 Ramesh. All rights reserved.
 */
namespace Ramesh\Storepickup\Model\ResourceModel;

/**
 * Store resource
 */
class StoreQuote extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('storepickup_store_quote', 'id');
    }

  
}
