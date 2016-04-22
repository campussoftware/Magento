<?php

namespace Campus\Connect\Block\Adminhtml\Config;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended {

    //put your code here
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory]
     */
    protected $_setsFactory;

    

    /**
     * @var \Magento\Catalog\Model\Product\Type
     */
    protected $_type;

    /**
     * @var \Magento\Catalog\Model\Product\Attribute\Source\Status
     */
    protected $_status;
    protected $_collectionFactory;

    /**
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $_visibility;

    /**
     * @var \Magento\Store\Model\WebsiteFactory
     */
    protected $_websiteFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Store\Model\WebsiteFactory $websiteFactory
     * @param \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $setsFactory
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Catalog\Model\Product\Type $type
     * @param \Magento\Catalog\Model\Product\Attribute\Source\Status $status
     * @param \Magento\Catalog\Model\Product\Visibility $visibility
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Magento\Store\Model\WebsiteFactory $websiteFactory, \Campus\Connect\Model\ResourceModel\EntityType\Collection $collectionFactory, \Magento\Framework\Module\Manager $moduleManager, array $data = []
    ) {

        $this->_collectionFactory = $collectionFactory;
        $this->_websiteFactory = $websiteFactory;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct() {
        parent::_construct();

        $this->setId('productGrid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return Store
     */
    protected function _getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return $this->_storeManager->getStore($storeId);
    }

    /**
     * @return $this
     */
    protected function _prepareCollection() {
        try {


            $collection = $this->_collectionFactory->load();



            $this->setCollection($collection);

            parent::_prepareCollection();

            return $this;
        } catch (Exception $e) {
            echo $e->getMessage();
            
        }
    }

    

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns() {
        $this->addColumn(
                'entity_type_id', [
            'header' => __('ID'),
            'type' => 'number',
            'index' => 'entity_type_id',
            'header_css_class' => 'col-id',
            'column_css_class' => 'col-id'
                ]
        );

        $this->addColumn(
            'name', [
            'header' => __('Name'),
            'index' => 'name',
            'class' => 'name'
                ]
        );

        $this->addColumn(
            'short_code', [
            'header' => __('Short Code'),
            'index' => 'short_code',
            'class' => 'short_code'
                ]
        );
        $this->addColumn(
            'short_code', [
            'header' => __('Short Code'),
            'index' => 'short_code',
            'class' => 'short_code'
                ]
        );
        $this->addColumn(
            'sort_order', [
            'header' => __('Sort Order'),
            'index' => 'sort_order',
            'class' => 'sort_order'
                ]
        );
        $this->addColumn(
            'is_active', [
            'header' => __('Is Active'),
            'index' => 'is_active',
            'class' => 'is_active'
                ]
        );
        $this->addColumn(
            'created_dt', [
            'header' => __('Created Dt'),
            'index' => 'created_dt',
            'class' => 'created_dt'
                ]
        );
        $this->addColumn(
            'updated_dt', [
            'header' => __('Updated Dt'),
            'index' => 'updated_dt',
            'class' => 'updated_dt'
                ]
        );
        /* {{CedAddGridColumn}} */

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction() {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem(
                'delete', array(
            'label' => __('Delete'),
            'url' => $this->getUrl('connect/*/massDelete'),
            'confirm' => __('Are you sure?')
                )
        );
        return $this;
    }
    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('campusconnect/*/grid', ['_current' => true]);
    }

    /**
     * @param \Magento\Catalog\Model\Product|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'campusconnect/*/edit',
            ['store' => $this->getRequest()->getParam('store'), 'id' => $row->getId()]
        );
    }

}
