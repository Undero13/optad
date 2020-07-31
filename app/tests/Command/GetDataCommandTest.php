<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GetDataCommandTest extends KernelTestCase
{
    public function testItCanExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:getData');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
        'url' => 'https://api.optad360.com/testapi',
        ]);

        $output = $commandTester->getDisplay();

        $this->assertStringContainsString(
            "Api url is: https://api.optad360.com/testapi\n Data add to database",
            $output
        );
    }
}
