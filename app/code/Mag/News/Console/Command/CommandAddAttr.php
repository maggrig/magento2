<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mag\News\Console\Command;

use Mag\News\Controller\AddAttrib;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class CommandAddProd
 */
class CommandAddAttr extends Command
{
    /**
     * Name argument
     */
    const NAME_ARGUMENT = 'name';

    /**
     * Allow option
     */
    const ALLOW_ANONYMOUS = 'allow-anonymous';

    /**
     * Anonymous name
     */
    const ANONYMOUS_NAME = 'Anonymous';
    protected $addAttrib;

    public function __construct(AddAttrib $addAttrib)
    {
        $this->addAttrib = $addAttrib;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('example:newattr')
            ->setDescription('Add new attribute')
            ->setDefinition([
                new InputArgument(
                    self::NAME_ARGUMENT,
                    InputArgument::OPTIONAL,
                    'Name'
                ),
                new InputOption(
                    self::ALLOW_ANONYMOUS,
                    '-a',
                    InputOption::VALUE_NONE,
                    'Allow anonymous'
                ),

            ]);

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $AddAttrib = $this->addAttrib;
        $AddAttrib->addAttr($input);
    }

}
