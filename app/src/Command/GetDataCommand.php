<?php

namespace App\Command;

use App\Service\DataManager;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetDataCommand extends Command 
{
  protected static $defaultName = 'app:getdata';
  private $dataManager;

  public function __construct(DataManager $dataManager)
  {
    $this->dataManager = $dataManager;

    parent::__construct();
  }
 
  protected function configure()
  {
    $this
      ->setDescription('Get data from company api')
      ->setHelp('This command allows you get and save data from your company partners');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {

    try {
      $this->dataManager->getData('https://api.optad360.com/testapi');
      $this->dataManager->saveData();
      return Command::SUCCESS;
    } catch (Exception $e) {
      $output->writeln('<error>' . $e->getMessage() . '</error>');
      return Command::FAILURE;
    }
  }
}