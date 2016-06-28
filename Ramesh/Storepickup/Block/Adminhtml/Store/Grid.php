<?php

namespace Ramesh\Storepickup\Block\Adminhtml\Store;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended {

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory]
     */
    protected $_setsFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;

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
    \Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Magento\Store\Model\WebsiteFactory $websiteFactory, \Ramesh\Storepickup\Model\ResourceModel\Store\Collection $collectionFactory, \Magento\Framework\Module\Manager $moduleManager, array $data = []
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
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
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
            die;
        }
    }
    
    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns() {
        $yesnoOptions = array('' => 'All','0' => 'No','1' => 'Yes');
        $this->addColumn(
                'id', [
            'header' => __('ID'),
            'type' => 'number',
            'index' => 'id',
            'header_css_class' => 'col-id',
            'column_css_class' => 'col-id'
                ]
        );
        $this->addColumn(
                'name', [
            'header' => __('name'),
            'index' => 'name',
            'class' => 'name'
                ]
        );
        $this->addColumn(
                'short_code', [
            'header' => __('short_code'),
            'index' => 'short_code',
            'class' => 'short_code'
                ]
        );
        $this->addColumn(
                'is_pos', [
            'header' => __('is_pos'),
            'index' => 'is_pos',
            'class' => 'is_pos',
            'type'      => 'options',
            'options'   => $yesnoOptions,
                ]
        );   
        $this->addColumn(
            'sort_no', [
            'header' => __('sort_no'),
            'index' => 'sort_no',
            'class' => 'sort_no',            
            
                ]
        );
        $this->addColumn(
            'is_active', [
            'header' => __('is_active'),
            'index' => 'is_active',
            'class' => 'is_active',            
            'type'      => 'options',
            'options'   => $yesnoOptions,
                ]
        );        
        
        $this->addColumn(
                'postalcode', [
            'header' => __('postalcode'),
            'index' => 'postalcode',
            'class' => 'postalcode'
                ]
        );
        $this->addColumn(
                'emailid', [
            'header' => __('emailid'),
            'index' => 'emailid',
            'class' => 'emailid'
                ]
        );
        $this->addColumn(
                'phoneno', [
            'header' => __('phoneno'),
            'index' => 'phoneno',
            'class' => 'phoneno'
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
            'url' => $this->getUrl('storepickup/*/massDelete'),
            'confirm' => __('Are you sure?')
                )
        );
        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl() {
        return $this->getUrl('storepickup/*/index', ['_current' => true]);
    }

    /**
     * @param \Magento\Catalog\Model\Product|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row) {
        return $this->getUrl(
                        'storepickup/*/edit', ['store' => $this->getRequest()->getParam('store'), 'id' => $row->getId()]
        );
    }

}
