<?php

namespace Ramesh\Storepickup\Block\Adminhtml\Store\Edit\Tab;

class Storeadderess extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    public $country;

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
    , \Magento\Directory\Model\Config\Source\Country $country
    , array $data = array()
    ) {
        $this->country=$country;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm() {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('storepickup_store');
        $isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Store Adderess')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

        $fieldset->addField(
                'contact_first_name', 'text', array(
            'name' => 'contact_first_name',
            'label' => __('contact_first_name'),
            'title' => __('contact_first_name'),
            'required' => true,
                )
        );
        $fieldset->addField(
                'contact_last_name', 'text', array(
            'name' => 'contact_last_name',
            'label' => __('contact_last_name'),
            'title' => __('contact_last_name'),
            'required' => true,
                )
        );
        $fieldset->addField(
                'street1', 'text', array(
            'name' => 'street1',
            'label' => __('street1'),
            'title' => __('street1'),
            'required' => true,
                )
        );
        $fieldset->addField(
                'street2', 'text', array(
            'name' => 'street2',
            'label' => __('street2'),
            'title' => __('street2'),
                /* 'required' => true, */
                )
        );
        $fieldset->addField(
                'city', 'text', array(
            'name' => 'city',
            'label' => __('city'),
            'title' => __('city'),
            'required' => true,
                )
        );
        $fieldset->addField(
                'state', 'text', array(
            'name' => 'state',
            'label' => __('state'),
            'title' => __('state'),
            'required' => true,
                )
        );
        $fieldset->addField(
                'country', 'select', array(
            'name' => 'country',
            'label' => __('country'),
            'title' => __('country'),
            'values'=>$this->country->toOptionArray(),
            'required' => true,
                )
        );
        $fieldset->addField(
                'postalcode', 'text', array(
            'name' => 'postalcode',
            'label' => __('postalcode'),
            'title' => __('postalcode'),
            'required' => true,
                )
        );
        /* {{CedAddFormField}} */

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
    public function getTabLabel() {
        return __('Store Adderess');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle() {
        return __('Store Adderess');
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

}
