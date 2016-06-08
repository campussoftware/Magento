<?php
namespace Ramesh\Connect\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table for entity types
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('cn_entity_type'))
            ->addColumn(
                'entity_type_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false],
                'Entity Type Id'
            )
            ->addColumn(
                'magento_entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Magento Entity'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Name'
            )
            ->addColumn(
                'short_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false,'primary' => true],
                'Short Code'
            )
            ->addColumn(
                'sort_order',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                ['nullable' => false],
                'Sort Order'
            )
            ->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is Active'
            )            
            ->addColumn(
                'created_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                [],
                'Created At'
            )
            ->addColumn(
                'updated_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )                
            
            ->addIndex(
            $installer->getIdxName(
                'cn_entity_type',
                ['entity_type_id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['entity_type_id'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )
            ->setComment('CN Entity Types');

        $installer->getConnection()->createTable($table);
        
        $table = $installer->getConnection()
            ->newTable($installer->getTable('cn_entity_type_attributes'))
            ->addColumn(
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false,'primary' => true],
                'Entity Type Id'
            )
            ->addColumn(
                'entity_type_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Entity Type Id'
            )
            ->addColumn(
                'magento_attribute_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Magento Attribute Code'
            )
                
            ->addColumn(
                'attribute_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false],
                'Attribute Name'
            )
            ->addColumn(
                'attribute_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Attribute Code'
            )
            ->addColumn(
                'sort_order',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                ['nullable' => false],
                'Sort Order'
            )
            ->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is Active'
            )            
            ->addColumn(
                'created_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                [],
                'Created At'
            )
            ->addColumn(
                'updated_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            ) 
            ->setComment('CN Entity Types Attributes');

        $installer->getConnection()->createTable($table);
        
        /**
         * Create table for entity types
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('cn_status'))
            ->addColumn(
                'cn_status_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false],
                'Entity Type Id'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Name'
            )
            ->addColumn(
                'short_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false,'primary' => true],
                'Short Code'
            )
            ->addColumn(
                'sort_order',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                ['nullable' => false],
                'Sort Order'
            )
            ->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is Active'
            )            
            ->addColumn(
                'created_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                [],
                'Created At'
            )
            ->addColumn(
                'updated_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )                
            
            ->addIndex(
            $installer->getIdxName(
                'cn_entity_type',
                ['cn_status_id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['cn_status_id'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )
            ->setComment('CN Status');

        $installer->getConnection()->createTable($table);
        /**
         * Create table for Erp Details
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('cn_erp'))
            ->addColumn(
                'cn_erp_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false],
                'Erp Id'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Erp Name'
            )
            ->addColumn(
                'short_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false,'primary' => true],
                'Erp  Code'
            )
            ->addColumn(
                'sort_order',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                ['nullable' => false],
                'Sort Order'
            )
            ->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is Active'
            )            
            ->addColumn(
                'created_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                [],
                'Created At'
            )
            ->addColumn(
                'updated_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )                
            
            ->addIndex(
            $installer->getIdxName(
                'cn_erp',
                ['cn_erp_id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['cn_erp_id'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )
            ->setComment('CN Status');

        $installer->getConnection()->createTable($table);
        
        
        
        /**
         * Create table for entity Messages
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('cn_entity_targetdetails'))
            ->addColumn(
                'cn_entity_message_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false,'primary' => true],
                'Entity Message Id'
            )
            ->addColumn(
                'cn_entity_type_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false],
                'Entity Type Id'
            )
            ->addColumn(
                'displayname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false],
                'Target Display Name'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false],
                'Target Field Name'
            )
            ->addColumn(
                'created_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                [],
                'Created At'
            )
            ->addColumn(
                'updated_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )
        ->setComment('CN Entity Target Details');

        $installer->getConnection()->createTable($table);
        /**
         * Create table for entity Messages
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('cn_entity_message'))
            ->addColumn(
                'cn_entity_message_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false,'primary' => true],
                'Entity Message Id'
            )
            ->addColumn(
                'cn_entity_type_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false],
                'Entity Type Id'
            )
            ->addColumn(
                'cn_entity_type_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => false],
                'Entity Type'
            )   
            ->addColumn(
                'cn_magento_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Magento Id'
            )
            ->addColumn(
                'cn_target_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Target Id'
            )
            ->addColumn(
                'en_message_data_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_BIGINT,
                null,
                ['nullable' => true],
                'Message Data Id'
            )     
            ->addColumn(
                'cn_status_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Status'
            )
            ->addColumn(
                'error_message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                \Magento\Framework\DB\Ddl\Table::MAX_TEXT_SIZE,
                ['nullable' => true],
                'Error'
            )
            ->addColumn(
                'created_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                [],
                'Created At'
            )
            ->addColumn(
                'updated_dt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                '64k',
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )            
            
            
        ->setComment('CN Entity Message');

        $installer->getConnection()->createTable($table);
        
        /**
         * Create table for entity Messages Data
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('cn_message_data'))
            ->addColumn(
                'cn_message_data_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false,'primary' => true],
                'Message Data Id'
            )
            ->addColumn(
                'data',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                \Magento\Framework\DB\Ddl\Table::MAX_TEXT_SIZE,
                ['nullable' => false, 'default' => false],
                'Data'
            )            
        ->setComment('CN Message Data');

        $installer->getConnection()->createTable($table);
    }
}
