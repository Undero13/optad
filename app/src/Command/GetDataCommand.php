<?php

namespace App\Command;

use App\Service\DataManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
        ->setHelp('This command allows you get and save data from your company partners')
        ->addArgument('url', InputArgument::OPTIONAL, 'api url');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * $url - optional param - url to api
         */
        $url = $input->getArgument('url') ?? $_SERVER['BASE_URL'];
        $output->writeln('<question>Api url is: '. $url . '</question>');

        try {
            $this->dataManager->getDataFromApi($url);
            $this->dataManager->saveData();
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        $output->writeln('<info> Data add to database </info>');
        return Command::SUCCESS;
    }
}
