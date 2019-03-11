<?php
/**
 * Created by PhpStorm.
 * User: grig
 * Date: 10.03.2019
 * Time: 13:37
 */

namespace Mag\News\Controller;


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
    public $attributeOptionManagement;
    public $optionFactory;
    public $eavConfig;

    public function __construct(
        \Magento\Framework\App\State $state
        , \Magento\Eav\Model\Config $eavConfig
        , \Magento\Eav\Api\AttributeOptionManagementInterface $attributeOptionManagement
        , \Magento\Eav\Api\Data\AttributeOptionInterfaceFactory $optionFactory
    )
    {
        $this->eavConfig = $eavConfig;
        $this->attributeOptionManagement = $attributeOptionManagement;
        $this->optionFactory = $optionFactory;
        $this->state = $state;
    }

    function addAttr(InputInterface $input)
//     function addAttr()
    {
        $name = $input->getArgument(self::NAME_ARGUMENT);
//        $name ='grgrgrgr';
        $this->eavConfig->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            [
                'type' => 'text',
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'frontend' => '',
                'label' => 'My Attribute',
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
                'searchable' => true,
                'filterable' => true,
                'comparable' => true,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'wysiwyg_enabled' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
    }
}