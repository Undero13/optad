<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetDataCommand extends Command
{
  protected static $defaultName = 'app:get-data-from-api';

  protected function configure()
  {
    $this
      ->setDescription('Get data from company api')
      ->setHelp('This command allows you get and save data from your company partners');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
      return Command::SUCCESS;
      // return Command::FAILURE;
  }
}