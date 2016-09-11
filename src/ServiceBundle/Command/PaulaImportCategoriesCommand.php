<?php

namespace ServiceBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class PaulaImportCategoriesCommand
 *
 * @category   Emtii
 * @package    idea-ctp-paula
 * @subpackage ServiceBundle\Command
 * @author     Marcel Thiesies <marcel.thiesies@me.com>
 * @copyright  2016 emtii
 * @license    http://www.emtii.de MIT
 * @link       http://www.emtii.de
 */
class PaulaImportCategoriesCommand extends ContainerAwareCommand
{
    const NAME_OF_COMMAND = 'paula:import-categories';
    const NAME_OF_OPT_BATCHSIZE = 'batch-size';
    const MIN_BATCH_SIZE = 1;
    const MAX_BATCH_SIZE = 500;

    private $batchSize = 1;

    /**
     * First of all, you must configure the name of the command in the configure() method.
     * Then you can optionally define a help message and the input options and arguments.
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName(self::NAME_OF_COMMAND)
            // the short description shown while running "php bin/console paula:import-categories"
            ->setDescription('Import categories of given json to commerce tools platform.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create categories.')
            ->addOption(
                self::NAME_OF_OPT_BATCHSIZE,
                1,
                InputOption::VALUE_OPTIONAL,
                'Size of batches we work on in one Request.'
            );
    }

    /**
     * (optional)
     *
     * This method is executed before the interact() and the execute() methods.
     * Its main purpose is to initialize variables used in the rest of the command methods.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output); // TODO: Change the autogenerated stub
    }

    /**
     * (optional)
     *
     * This method is executed after initialize() and before execute().
     * Its purpose is to check if some of the options/arguments are missing and interactively ask the user
     * for those values. This is the last place where you can ask for missing options/arguments.
     * After this command, missing options/arguments will result in an error.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        // check for used option and set int typecasted value
        if ($input->hasOption(self::NAME_OF_OPT_BATCHSIZE)) {
            $optBatchSize = $input->getOption(self::NAME_OF_OPT_BATCHSIZE);

            // check for type and value > 1
            if (!is_numeric($optBatchSize) ||
                $optBatchSize < self::MIN_BATCH_SIZE ||
                $optBatchSize > self::MAX_BATCH_SIZE
            ) {
                $io->error('Invalid option used. Please use integer option type >= 1 and <= 500 only.');
            } else {
                $this->batchSize = (int)$optBatchSize;
            }
        }
    }

    /**
     * (required)
     *
     * This method is executed after interact() and initialize().
     * It contains the logic you want the command to execute.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // http://symfony.com/doc/current/components/stopwatch.html
        // $sw = new Stopwatch();

        // http://symfony.com/doc/current/console/style.html
        // $io = new SymfonyStyle($input, $output);

        // progress bar for execute
        // $io->progressStart();

        // table for stopwatch results
        // $io->table();
    }
}
