<?php
namespace Campus\Connect\Block\Adminhtml\Config;
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize form
     * Add standard buttons
     * Add "Save and Apply" button
     * Add "Save and Continue" button
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'entity_type_id';
        $this->_blockGroup = 'Campus_Connect';
        $this->_controller = 'adminhtml_configuration';

        parent::_construct();
        
        if ($this->_coreRegistry->registry('campusconnect_entitytype')->getId()) {
            $this->buttonList->remove('reset');
        }
    }

    /**
     * Getter for form header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $config = $this->_coreRegistry->registry('campusconnect_entitytype');
        if ($config->getId()) {
            return __("Edit Config '%1'", $this->escapeHtml($config->getName()));
        } else {
            return __('New Config');
        }
    }
}
