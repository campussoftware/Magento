<?php
namespace Ramesh\Storepickup\Block\Adminhtml\Store\Edit\Tab;
class Storedetails extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
		/* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('storepickup_store');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Store Details')));
        $is_activechecked=false;
        if ($model->getId()) 
        {
            if($model->getIsActive()==1)
            {
                $is_activechecked=true;
            }            
        }
        $is_poschecked=false;
        if ($model->getId()) 
        {
            if($model->getIsPos()==1)
            {
                $is_poschecked=true;
            }            
        }
        
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

        $fieldset->addField(
            'name',
            'text',
            array(
                'name' => 'name',
                'label' => __('name'),
                'title' => __('name'),
                'required' => true,
            )
        );
        $fieldset->addField(
            'short_code',
            'text',
            array(
                'name' => 'short_code',
                'label' => __('code'),
                'title' => __('code'),
                'required' => true,
            )
        );
        $fieldset->addField(
            'image',
            'image',
            array(
                'name' => 'image',
                'label' => __('image'),
                'title' => __('image'),
                'note' => 'Allow image type: jpg, jpeg, gif, png',
                
            )
        );
        $fieldset->addField(
            'is_default',
            'checkbox',
            array(
                'name' => 'is_default',
                'label' => __('is_default'),
                'title' => __('is_default'),
                'onclick' => 'this.value = this.checked ? 1 : 0;',
                'checked' => $is_activechecked,
            )
        );
        $fieldset->addField(
            'is_pos',
            'checkbox',
            array(
                'name' => 'is_pos',
                'label' => __('is_pos'),
                'title' => __('is_pos'),
                'onclick' => 'this.value = this.checked ? 1 : 0;',
                'checked' => $is_poschecked,
            )
        );
        $fieldset->addField(
            'emailid',
            'text',
            array(
                'name' => 'emailid',
                'label' => __('emailid'),
                'title' => __('emailid'),
                /*'required' => true,*/
            )
        );
        $fieldset->addField(
            'phoneno',
            'text',
            array(
                'name' => 'phoneno',
                'label' => __('phoneno'),
                'title' => __('phoneno'),
                /*'required' => true,*/
            )
        );
        $fieldset->addField(
            'longitude',
            'text',
            array(
                'name' => 'longitude',
                'label' => __('longitude'),
                'title' => __('longitude'),
                /*'required' => true,*/
            )
        );
	$fieldset->addField(
            'latitude',
            'text',
            array(
                'name' => 'latitude',
                'label' => __('latitude'),
                'title' => __('latitude'),
                /*'required' => true,*/
            )
        );
        $fieldset->addField(
            'sort_no',
            'text',
            array(
                'name' => 'sort_no',
                'label' => __('sort_no'),
                'title' => __('sort_no'),
                'required' => false,
            )
        );
        $fieldset->addField(
            'is_active',
            'checkbox',
            array(
                'name' => 'is_active',
                'label' => __('is_active'),
                'title' => __('is_active'),
                'onclick' => 'this.value = this.checked ? 1 : 0;',
                'checked' => $is_activechecked,
            )
        );
        
		
		/*{{CedAddFormField}}*/
        
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Store Details');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Store Details');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
