<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ramesh\Connect\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    
    public $entityErp;
    public $entitytype;
    /**
     * Init
     *
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(\Ramesh\Connect\Model\ErpFactory $entityErp,\Ramesh\Connect\Model\EntitytypeFactory $entitytype)
    {
        $this->entityErp = $entityErp;
        $this->entitytype=$entitytype;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity 
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $entitytype=$this->entitytype->create();
        $entitytype=$entitytype->load("Customer",'short_code');
        $entitytype->setName("Customer");
        $entitytype->setShortCode("Customer");
        $entitytype->setSortOrder("2");
        $entitytype->setIsActive("1");
        $entitytype->save();
        
        $entitytype=$this->entitytype->create();
        $entitytype=$entitytype->load("Address",'short_code');
        $entitytype->setName("Address");
        $entitytype->setShortCode("Address");
        $entitytype->setSortOrder("2");
        $entitytype->setIsActive("1");
        $entitytype->save();
        
        $entitytype=$this->entitytype->create();
        $entitytype=$entitytype->load("Product",'short_code');
        $entitytype->setName("Product");
        $entitytype->setShortCode("Product");
        $entitytype->setSortOrder("3");
        $entitytype->setIsActive("1");
        $entitytype->save();
        
        $entitytype=$this->entitytype->create();
        $entitytype=$entitytype->load("Inventory",'short_code');
        $entitytype->setName("Inventory");
        $entitytype->setShortCode("Inventory");
        $entitytype->setSortOrder("4");
        $entitytype->setIsActive("1");
        $entitytype->save();
        
        $entitytype=$this->entitytype->create();
        $entitytype=$entitytype->load("Order",'short_code');
        $entitytype->setName("Order");
        $entitytype->setShortCode("Order");
        $entitytype->setSortOrder("5");
        $entitytype->setIsActive("1");
        $entitytype->save();
        
        $entitytype=$this->entitytype->create();
        $entitytype=$entitytype->load("OrderItem",'short_code');
        $entitytype->setName("Order Item");
        $entitytype->setShortCode("OrderItem");
        $entitytype->setSortOrder("6");
        $entitytype->setIsActive("1");
        $entitytype->save();
        
        $entityErp=$this->entityErp->create();
        $entityErp=$entityErp->load("Salesforce",'short_code');
        $entityErp->setName("Salesforce");
        $entityErp->setShortCode("Salesforce");
        $entityErp->setSortOrder("1");
        $entityErp->setIsActive("1");
        $entityErp->save();
        
        
        $entityErp=$this->entityErp->create();
        $entityErp=$entityErp->load("Zohocrm",'short_code');
        $entityErp->setName("Zohocrm");
        $entityErp->setShortCode("Zohocrm");
        $entityErp->setSortOrder("2");
        $entityErp->setIsActive("1");
        $entityErp->save();
    }
}
