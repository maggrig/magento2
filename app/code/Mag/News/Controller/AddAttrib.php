<?php
/**
 * Created by PhpStorm.
 * User: grig
 * Date: 10.03.2019
 * Time: 13:37
 */

namespace Mag\News\Controller;


use Mag\News\Helper\Data;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Helper\Bootstrap;
use Symfony\Component\Console\Input\InputInterface;

class AddAttrib
{
    /**
     * Name argument
     */
    public const NAME_ARGUMENT = 'name';
    /**
     * Allow option
     */
    public const ALLOW_ANONYMOUS = 'allow-anonymous';
    /**
     * Anonymous name
     */
    public const ANONYMOUS_NAME = 'Anonymous';

    public $state;
    public $eavConfig;
    public $attributeOptionManagement;
    public $optionFactory;
    public $optionLabelFactory;
    public $helper;

    public function __construct(
//        Data $helper,
        \Magento\Framework\App\State $state,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Eav\Api\AttributeOptionManagementInterface $attributeOptionManagement,
        \Magento\Eav\Api\Data\AttributeOptionLabelInterfaceFactory $optionLabelFactory,
        \Magento\Eav\Api\Data\AttributeOptionInterfaceFactory $optionFactory
    )
    {
//        $this->helper=$helper;
        $this->state = $state;
        $this->eavConfig=$eavConfig;
        $this->attributeOptionManagement=$attributeOptionManagement;
        $this->optionLabelFactory=$optionLabelFactory;
        $this->optionFactory=$optionFactory;
    }

//    function addAttr(InputInterface $input)
     function addAttr()
    {
//        $name = $input->getArgument(self::NAME_ARGUMENT);
//        $name = 'grgrgrgr';
        /* Create attribute */
//         $attribute_id = $this->_attributeRepository->get('catalog_product', 'Color')->getAttributeId();
//         $options = $this->_attributeOptionManagement->getItems('catalog_product', $attribute_id);
         /* if attribute option already exists, remove it */
//         foreach($options as $option) {
//             if ($option->getLabel() == $name) {
//                 $this->_attributeOptionManagement->delete('catalog_product', $attribute_id, $option->getValue());
//             }
//         }
         /* new attribute option */
//         $this->_option->setValue($name);
//         $this->_attributeOptionLabel->setStoreId(0);
//         $this->_attributeOptionLabel->setLabel($name);
//         $this->_option->setLabel($this->_attributeOptionLabel);
//         $this->_option->setStoreLabels([$this->_attributeOptionLabel]);
//         $this->_option->setSortOrder(0);
//         $this->_option->setIsDefault(false);

     //    $this->_attributeRepository->save();
//         $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
//         $entityType = $objectManager->create('Magento\Eav\Model\Entity\Type')->loadByCode('catalog_product');
//         $data = [
//             'attribute_set_name' => 'attribute_set_with_media_attribute',
//             'entity_type_id' => $entityType->getId(),
//             'sort_order' => 200,
//         ];
//         $this->_attributeRepository->setData($data);
//         $this->_attributeRepository->validate();
//         $this->_attributeRepository->save();
//         $this->_attributeRepository->initFromSkeleton($defaultSetId);
//         $this->_attributeRepository->save();

//         $this->_attributeOptionManagement->add('catalog_product', $attribute_id, $this->_option);
    }
    public function addAttributeOption($attributeCode, $value)
{
    /** @var \Magento\Eav\Model\Entity\Attribute\OptionLabel$ optionLabel */
    $optionLabel =$this->optionLabelFactory->create();
    $optionLabel->setStoreId(0);
    $optionLabel->setLabel( $value);
    $option = $this->optionFactory->create();
    $option->setLabel( $optionLabel);
    $option->setStoreLabels([ $optionLabel]);
    $option->setSortOrder(0);
    $option->setIsDefault(false);
    $this->attributeOptionManagement->add(
      'catalog_product',
      $attributeCode,$option
    );

    // Get the inserted ID. Should be returned from the installer, but it isn't.
    $attribute =$this->eavConfig->getAttribute('catalog_product', $attributeCode);
    $optionId = $attribute->getSource()->getOptionId($value);
    return $optionId;
}
function addAttribByHelper()
{
    $this->startSetup();

    $this->addAttribute('catalog_category', 'new_attribute', array(
        'group'         => 'General',
        'input'         => 'text',
        'type'          => 'varchar',
        'label'         => 'New attribute',
        'backend'       => '',
        'visible'       => 1,
        'required'      => 0,
        'user_defined'  => 1,
        'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    ));

    $this->endSetup();

//    try {
//        $this->helper->createOrGetId(93, 'asdasdsadsadsdsadsa');
//    } catch (LocalizedException $e) {
//    }
}
}