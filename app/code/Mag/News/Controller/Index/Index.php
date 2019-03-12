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
    public function __construct(
        ViewCore $helper,
        \Magento\Framework\App\Action\Context $context
        , \Mag\News\Controller\AddAttrib $addAttrib
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
        $this->helper=$helper;
        $this->addAttrib  = $addAttrib;
        return parent::__construct($context);
    }
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
$this->helper->setUp();
//        $addAttrib = $this->addAttrib;
//        if ($AddProd instanceof AddProd)
//        $addAttrib->addAttribByHelper();

        echo "Hello World";
        exit();
        //    return $this->_pageFactory->create();
    }
}
