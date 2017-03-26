<?php
namespace Ramesh\WindowScroll\Block;

class ScrollTop extends \Magento\Framework\View\Element\Template {

   /**
   * @var \Magento\Framework\App\Config\ScopeConfigInterface
   */
   protected $scopeConfig;
   const XML_PATH_SCROLLTOP_ENABLE="windowscroll/general/scrolltop_enable";
   
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
	\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig) {
		$this->scopeConfig = $scopeConfig;
        parent::__construct($context);        
    }
	public function isEnable()
	{
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
		return $this->scopeConfig->getValue(self::XML_PATH_SCROLLTOP_ENABLE, $storeScope);
	}
}