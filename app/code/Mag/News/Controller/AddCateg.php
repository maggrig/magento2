<?php

namespace Mag\News\Controller;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Created by PhpStorm.
 * User: grig
 * Date: 05.03.2019
 * Time: 9:08
 */
class AddCateg
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


    function addCateg(InputInterface $input, OutputInterface $output)
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
        $objectManagerr = \Magento\Framework\App\ObjectManager::getInstance();
        $parentId = \Magento\Catalog\Model\Category::TREE_ROOT_ID;

        $parentCategory = $objectManagerr
            ->create('Magento\Catalog\Model\Category')
            ->load($parentId);
        $category = $objectManagerr
            ->create('Magento\Catalog\Model\Category');
//Check exist category
        $cate = $category->getCollection()
            ->addAttributeToFilter('name', $name)
            ->getFirstItem();

        if ($cate->getId() == null) {
            $category->setPath($parentCategory->getPath())
                ->setParentId($parentId)
                ->setName($name)
                ->setIsActive(true);
            $category->save();
            $output->writeln('Successfully add category:' . $name);

        } else {
            $output->writeln('Category <' . $name . '> exist');
        }
    }

}