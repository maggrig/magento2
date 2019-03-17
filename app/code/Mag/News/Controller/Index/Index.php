<?php


namespace Mag\News\Controller\Index;

use Mag\News\Helper\ViewCore;

class Index extends \Magento\Framework\App\Action\Action
{

    public $addAttrib;
    protected $optionFactory;
    protected $attributeOptionManagement;
    protected $optionLabelFactory;
    public $eavConfig;
    public $helper;
    protected $_scopeConfig;
    public function __construct(
        ViewCore $helper,
        \Magento\Framework\App\Action\Context $context
        , \Mag\News\Controller\AddAttrib $addAttrib
        ,\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
//        , \Magento\Eav\Model\Config $eavConfig
//        , \Magento\Eav\Api\AttributeOptionManagementInterface $attributeOptionManagement
//        , \Magento\Eav\Api\Data\AttributeOptionLabelInterfaceFactory $optionLabelFactory
//        , \Magento\Eav\Api\Data\AttributeOptionInterfaceFactory $optionFactory
    )
    {
//        $this->eavConfig = $eavConfig;
//        $this->attributeOptionManagement = $attributeOptionManagement;
//        $this->optionLabelFactory = $optionLabelFactory;
//        $this->optionFactory = $optionFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->helper=$helper;
        $this->addAttrib  = $addAttrib;
        return parent::__construct($context);
    }
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        echo $this->scopeConfig->getValue("catalog/Product News/custom_text", $storeScope);
//$this->helper->setUp();
//        $addAttrib = $this->addAttrib;
//        if ($AddProd instanceof AddProd)
//        $addAttrib->addAttribByHelper();

        echo "Hello World";
        exit();
        //    return $this->_pageFactory->create();
    }
}
