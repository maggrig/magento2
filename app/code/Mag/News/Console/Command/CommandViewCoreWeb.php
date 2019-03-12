<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mag\News\Console\Command;

use Mag\News\Helper\ViewCore;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class CommandViewCoreWeb
 */
class CommandViewCoreWeb extends Command
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
    protected $viewCore;
    public function __construct(ViewCore $viewCore)
    {
        $this->viewCore = $viewCore;
        parent::__construct();
    }
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('example:viewCore')
            ->setDescription('View Core Web page') ;
        parent::configure();
    }
    /**
     * {@inheritdoc}
     */
    protected function execute( InputInterface $input,OutputInterface $output)
    {
         $view= $this->viewCore;
       $out= $view->viewCoreWeb( $output);

        $output->writeln('Successfully ');
        $output->writeln($out[0]);
        $output->writeln($out[1]);
        $output->writeln($out[2]);
        $output->writeln($out[3]);
    }

}
