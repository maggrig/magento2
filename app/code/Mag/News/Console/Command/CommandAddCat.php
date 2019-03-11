<?php
/**
 * Created by PhpStorm.
 * User: grig
 * Date: 27.02.2019
 * Time: 22:29
 */

namespace Mag\News\Console\Command;


use Mag\News\Controller\AddCateg;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class CommandAddCat
 */
class CommandAddCat extends Command
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

    protected $addCat;

    public function __construct(AddCateg $addCateg)
    {
        $this->addCat = $addCateg;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('example:newcat')
            ->setDescription('Add New Category')
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
        $AddCateg = $this->addCat;
        $AddCateg->addCateg($input, $output);
    }


}