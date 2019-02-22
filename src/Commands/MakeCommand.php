<?php

namespace Imponeer\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class MakeCommand extends Command {

    /**
     * @inheritDoc
     */
    public function __construct($name = null)
    {
        $this->addArgument(
            'output_file',
            InputArgument::OPTIONAL,
            'File where to write output',
            'setup.phar'
        );

        $this->addOption(
            'offline',
            'o',
            InputOption::VALUE_OPTIONAL,
            "Makes installer for offline installation",
            false
            );

        parent::__construct($name);
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output = $input->getArgument('output_file');
        $offline = $input->getOption('offline');

        $queue = new \SplQueue();
        $phar = new \Phar($output);

        $progress_bar = new ProgressBar($output, $queue->count());
        $progress_bar->start();
        while($job = $queue->dequeue()) {
            $progress_bar->advance();
            $job->execute($phar, $offline);
        }
        $progress_bar->finish();
    }
}