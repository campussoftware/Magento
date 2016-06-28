<?php

/**
 * Copyright © 2015 Ramesh. All rights reserved.
 */

namespace Ramesh\Storepickup\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface {

    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {

        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'storepickup_store'
         */
        $table = $installer->getConnection()->newTable(
                        $installer->getTable('storepickup_store')
                )
                ->addColumn(
                        'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'storepickup_store'
                )
                ->addColumn(
                        'name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'name'
                )
                ->addColumn(
                        'short_code', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'short_code'
                )
                ->addColumn(
                        'image', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'image'
                )
                ->addColumn(
                        'sort_no', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => true], 'sort_no'
                )
                ->addColumn(
                        'is_default', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => true], 'is_default'
                )
                ->addColumn(
                        'is_pos', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => true], 'is_pos'
                )
                ->addColumn(
                        'longitude', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'longitude'
                )
                ->addColumn(
                        'latitude', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'latitude'
                )
                ->addColumn(
                        'is_active', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'is_active'
                )
                ->addColumn(
                        'contact_first_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'contact_first_name'
                )
                ->addColumn(
                        'contact_last_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'contact_last_name'
                )
                ->addColumn(
                        'street1', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'street1'
                )
                ->addColumn(
                        'street2', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'street2'
                )
                ->addColumn(
                        'city', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'city'
                )
                ->addColumn(
                        'state', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'state'
                )
                ->addColumn(
                        'country', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'country'
                )
                ->addColumn(
                        'postalcode', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'postalcode'
                )
                ->addColumn(
                        'emailid', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'emailid'
                )
                ->addColumn(
                        'phoneno', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'phoneno'
                )
                /* {{CedAddTableColumn}}} */
                ->setComment(
                'Ramesh Storepickup storepickup_store'
        );

        $installer->getConnection()->createTable($table);
        /* {{CedAddTable}} */

        $table = $installer->getConnection()->newTable(
                        $installer->getTable('storepickup_store_inventory')
                )
                ->addColumn(
                        'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'storepickup_store'
                )
                ->addColumn(
                        'storepickup_store_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'storepickup_store_id'
                )
                ->addColumn(
                        'product_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'product_id'
                )
                ->addColumn(
                        'qty', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'qty'
                )


                /* {{CedAddTableColumn}}} */
                ->setComment(
                'Ramesh Storepickup storepickup_store'
        );

        $installer->getConnection()->createTable($table);
        /* {{CedAddTable}} */


        $installer->endSetup();
    }

}
