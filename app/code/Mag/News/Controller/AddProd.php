<?php
/**
 * Created by PhpStorm.
 * User: grig
 * Date: 06.03.2019
 * Time: 21:09
 */

namespace Mag\News\Controller;


use Symfony\Component\Console\Input\InputInterface;

class AddProd
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
//    public $attributeOptionManagement;
//    public $optionFactory;
//    public $eavConfig;

    public function __construct(
        \Magento\Framework\App\State $state
//        , \Magento\Eav\Model\Config $eavConfig
//        , \Magento\Eav\Api\AttributeOptionManagementInterface $attributeOptionManagement
//        , \Magento\Eav\Api\Data\AttributeOptionInterfaceFactory $optionFactory
    )
    {
//        $this->eavConfig = $eavConfig;
//        $this->attributeOptionManagement = $attributeOptionManagement;
//        $this->optionFactory = $optionFactory;
        $this->state = $state;
//        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
    }

    function addProd(InputInterface $input)
    {
        $name = $input->getArgument(self::NAME_ARGUMENT);
        $allowAnonymous = $input->getOption(self::ALLOW_ANONYMOUS);
        if (is_null($name)) {
            if ($allowAnonymous) {
                $name = self::ANONYMOUS_NAME;
            } else {
                throw new \InvalidArgumentException('Argument ' . self::NAME_ARGUMENT . ' is missing.');
            }
        }

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager
        $product = $objectManager->create('\Magento\Catalog\Model\Product');
        $product->setSku('mysku'); // Set your sku here
        $product->setName($name); // Name of Product
        $product->setAttributeSetId(4); // Attribute set id
        $product->setStatus(1); // Status on product enabled/ disabled 1/0
        $product->setWeight(10); // weight of product
        $product->setVisibility(4); // visibilty of product (catalog / search / catalog, search / Not visible individually)
        $product->setTaxClassId(0); // Tax class id
        $product->setTypeId('simple'); // type of product (simple/virtual/downloadable/configurable)
        $product->setPrice(100); // price of product
        $product->setStockData(
            array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'is_in_stock' => 1,
                'qty' => 999999999
            )
        );
        $product->save();
        echo "All ok";
    }

    function addTestProd()
    {
        $name = 'New product 1';
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager
        $product = $objectManager->create('\Magento\Catalog\Model\Product');
        //       $product->
        $product->setSku('mysku'); // Set your sku here
        $product->setName($name); // Name of Product
        $product->setAttributeSetId(4); // Attribute set id
        $product->setStatus(1); // Status on product enabled/ disabled 1/0
        $product->setWeight(10); // weight of product
        $product->setVisibility(4); // visibilty of product (catalog / search / catalog, search / Not visible individually)
        $product->setTaxClassId(0); // Tax class id
        $product->setTypeId('simple'); // type of product (simple/virtual/downloadable/configurable)
        $product->setPrice(100); // price of product
        $product->setStockData(
            array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'is_in_stock' => 1,
                'qty' => 999999999
            )
        );
        $product->save();
        echo "Test ok";
    }

}