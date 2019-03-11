<?php


namespace Mag\News\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resPageFactory;
    protected $addProd;
    protected $optionFactory;
    protected $attributeOptionManagement;
    protected $optionLabelFactory;

    public $eavConfig;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
        , \Mag\News\Controller\AddProd $addProd
        , \Magento\Eav\Model\Config $eavConfig
        , \Magento\Eav\Api\AttributeOptionManagementInterface $attributeOptionManagement
        , \Magento\Eav\Api\Data\AttributeOptionLabelInterfaceFactory $optionLabelFactory
        , \Magento\Eav\Api\Data\AttributeOptionInterfaceFactory $optionFactory
    )
    {
        $this->eavConfig = $eavConfig;
        $this->attributeOptionManagement = $attributeOptionManagement;
        $this->optionLabelFactory = $optionLabelFactory;
        $this->optionFactory = $optionFactory;

        $this->resPageFactory = $resultPageFactory;
        $this->addProd = $addProd;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()

    {

        //   $Command_my = this->_command_my;
        // if($Command_my instanceof AddCateg)
        //   $Command_my->addCateg();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeRepository = $objectManager->get('\Magento\Catalog\Api\ProductAttributeRepositoryInterface');
        $indexAdmin = 0;
        $indexEnglish = 12; // be nice to get this dynamically
        $attribute = $objectManager->get('Magento\Catalog\Model\ResourceModel\Eav\Attribute');
        //------------------------------------------------
        // describe the attributes we want to add; all array fields are optional
        $attributes_meta = array(
            'Finish' => array(
//        'admin' => 'color',
                'type' => 'swatch_visual', // boolean, text, textarea, date, select, multiselect, swatch_text, swatch_visual, media_image
                'visible' => true,
                'options' => array(
                    'American Chestnut',
                    'Black Cherry',
                    'Cherry',
                    'Espresso',
                    'Honey',
                    'Mahogany',
                    'Natural',
                    'Oak',
                    'Pecan',
                    'Unfinished',
                    'Walnut',
                ),
            ),
        );
// cycle through and add each attribute
        foreach ($attributes_meta as $attribute_label => $attribute_meta) {
            $attribute_label_admin = empty($attribute_meta['admin']) ? labelToSnakeCase($attribute_label) : $attribute_meta['admin'];
            $attribute_type = empty($attribute_meta['type']) ? 'text' : $attribute_meta['type'];
            $attribute_data = array(
                // table eav_attribute
                'entity_type_id' => $installer->getEntityTypeId('catalog_product'),
                'attribute_code' => $attribute_label_admin,
                // 'attribute_model' => NULL,
                // 'backend_model' => NULL,
                'backend_type' => 'int',
                // 'backend_table' => NULL,
                // 'frontend_model' => NULL,
                'frontend_input' => 'swatch_' === substr($attribute_type, 0, strlen('swatch_')) ? 'select' : $attribute_type,
                'frontend_label' => [$attribute_label],
                // 'frontend_class' => NULL,
                // 'source_model' => NULL,
                'is_required' => 0,
                'is_user_defined' => 1,
                // 'default_value' =>
                'is_unique' => 0,
                // table catalog_eav_attribute
                'is_global' => 1,
                'is_visible' => 1,
                'is_searchable' => 0,
                'is_filterable' => 0,
                'is_comparable' => 0,
                'is_visible_on_front' => 0,//empty($attribute_meta['visible']) ? 0 : 1,
                'is_html_allowed_on_front' => 1,
                'is_used_for_price_rules' => 0,
                'is_filterable_in_search' => 0,
                'used_in_product_listing' => 0,
                'used_for_sort_by' => 0,
                // 'apply_to' => NULL,
                'is_visible_in_advanced_search' => 1,
                // 'position' => 0,
                'is_wysiwyg_enabled' => 0,
                'is_used_for_promo_rules' => 0,
                'is_required_in_admin_store' => 0,
                'is_used_in_grid' => 1,
                'is_visible_in_grid' => 1,
                'is_filterable_in_grid' => 1,
                // 'search_weight' => 1,
//        'update_product_preview_image' => 1, // not sure how to control this but this doesn't work
            );
            if (!empty($attribute_meta['options'])) {
                $options = array();
                $options['value'] = array();
                foreach ($attribute_meta['options'] as $option_label) {
                    $option_label_admin = labelToSnakeCase($option_label);
                    $option[$indexAdmin] = $option_label_admin;
                    $option[$indexEnglish] = $option_label;
                    $options['value'][$option_label_admin] = $option;
//            $options['order'][$option_label_admin] = $index;
                }
                $attribute_data['option'] = $options;
            }
            if ('swatch_visual' === $attribute_type) {
                // table catalog_eav_attribute
                $attribute_data['additional_data'] = array(
                    'swatch_input_type' => 'visual',
                    'update_product_preview_image' => 0,
                    'use_product_image_for_swatch' => 0,
                );
                // there must be a proper way to set this...
                $attribute_data['additional_data'] = 'a:3:{s:17:"swatch_input_type";s:6:"visual";s:28:"update_product_preview_image";s:1:"0";s:28:"use_product_image_for_swatch";s:1:"0";}';
            }
            $attribute = $objectManager->get('Magento\Catalog\Model\ResourceModel\Eav\Attribute');
            $attribute->setData($attribute_data);
            try {
                $attributeRepository->save($attribute);
            } catch (Magento\Framework\Exception\AlreadyExistsException $e) {
                echo "$attribute_label already exists\n";
                continue;
            }
            $installer->addAttributeToGroup('catalog_product', 'Default', 'General', $attribute->getId());
            echo "$attribute_label added\n";
        }

        //------------------------------------------------


        $AddProd = $this->addProd;
//        if ($AddProd instanceof AddProd)
//            $AddProd->addAttr();
        $this->eavConfig->importAttributesData(
            \Magento\Catalog\Model\Product::ENTITY,
            [
                'type' => 'text',
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'frontend' => '',
                'label' => 'qqqqqqqqqqqqqq',
                'input' => 'multiselect',
                'class' => '',
                // instead values change your key as value and add your option like below with in `option_1`  array put key as store_id and label as value
                'option' => ['value' =>
                    [
                        'option_1' => [
                            //option_1 will be static it will add below labels in option_1 for **new**
                            0 => 'label for admin',    // here 0 is store id and 123 is value
                            1 => 'label for store1',
                            13 => 'label for store 13',
                            14 => 12121,
                            15 => 1212,
                            16 => 123
                        ],
                        'option_2' => [
                            0 => 'label for admin',
                            1 => 'label for store1',
                            13 => 'label for store 13',
                            14 => 32123,
                            15 => 123123123,
                            16 => 5152
                        ],
                    ],
                    'order' =>//Here We can Set Sort Order For Each Value.
                        [
                            'option_1' => 1,
                            'option_2' => 2
                        ]
                ],
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'wysiwyg_enabled' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
//        $this->eavConfig->
        echo "Hello World";
        exit();
        //    return $this->_pageFactory->create();
    }
}
