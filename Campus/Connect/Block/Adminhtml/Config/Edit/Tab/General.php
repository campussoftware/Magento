<?php

namespace Campus\Connect\Block\Adminhtml\Config\Edit\Tab;

class General extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_resource;
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context
    , \Magento\Framework\Registry $registry
    , \Magento\Framework\Data\FormFactory $formFactory
    , \Magento\Store\Model\System\Store $systemStore
    , \Magento\Framework\App\ResourceConnection $resource
    , array $data = array()
    ) {
        $this->_systemStore = $systemStore;
         $this->_resource = $resource;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm() {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('campusconnect_entitytype');
        $isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        
        $form->setHtmlIdPrefix('page_');

        $fieldset =
                $form->addFieldset('base_fieldset', array('legend' => __('General')));
        $is_activechecked=false;
        if ($model->getId()) 
        {
            if($model->getIsActive()==1)
            {
                $is_activechecked=true;
            }
            $fieldset->addField('entity_type_id', 'hidden', array('name' => 'entity_type_id'));
        }
        $fieldset->addField(
            'magento_entity_id', 'select', array(
            'name' => 'magento_entity_id',
            'label' => __('Magento Entity'),
            'title' => __('Magento Entity'),
            'values'=>$this->getMagentoEntityTypes(),
            
                )
        );
        $fieldset->addField(
            'name', 'text', array(
            'name' => 'name',
            'label' => __('Name'),
            'title' => __('Name'),
            'required' => true,
                
                )
        );
        
        $fieldset->addField(
            'short_code', 'text', array(
            'name' => 'short_code',
            'label' => __('Short Code'),
            'title' => __('Short Code'),
            'required' => true,
                )
        );
        $fieldset->addField(
            'sort_order','text', array(
            'label' => __('Sort Order'),
            'name' => 'sort_order',
            'title' => __('Sort Order')
                )
        );
        $fieldset->addField(
            'is_active','checkbox',array(
            'label' => __('Is Active'),
            'title' => __('Is Active'),
            'name' => 'is_active',
            'checked' => $is_activechecked,
                )
        );        
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * 
     * @return type
     */ 
    public function getTabLabel() {
        return __('General');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle() {
        return __('General');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden() {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId) {
        return $this->_authorization->isAllowed($resourceId);
    }
    protected function getMagentoEntityTypes()
    {
        $entityTypes=array("0"=>"None");
        $connection=$this->_resource->getConnection();
        $entityTable = $this->_resource->getTableName('eav_entity_type');
        $sql = "select * FROM " . $entityTable . ";";
        $result=$connection->fetchAll($sql);
        if(count($result)>0)
        {
            foreach($result as $rs)
            {
                $entityTypes[$rs['entity_type_id']]=__($rs['entity_type_code']);
            }
        }
        return $entityTypes;
    }
}
