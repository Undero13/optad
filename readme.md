## Start
- docker-compose up
- server will start auto
- use command php bin/console app:getdata or php bin/console app:getdata -- <urlParam>, default url is https://api.optad360.com/testapi

## Linter
- phpcbf - composer phpcbf
- ecs - composer ecs -- --fix

## Test
- bin/phpunit -c phpunit.xml - run tests

Example phpunit.xml 

<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/8.3/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         executionOrder="depends,defects"
         forceCoversAnnotation="true"
         beStrictAboutCoversAnnotation="true"
         beStrictAboutOutputDuringTests="true"
         beStrictAboutTodoAnnotatedTests="true"
         verbose="true">
    <testsuites>
        <testsuite name="default">
            <directory suffix="Test.php">tests</directory>
        </testsuite>
    </testsuites>

    <php>
      <env name="KERNEL_CLASS" value="App\Kernel" />
      <env name="DATABASE_URL" value="mysql://root:root@mysql:3306/optad?serverVersion=5.7" />
      <env name="BASE_URL" value="https://api.optad360.com/testapi" />
    </php>

    <filter>
        <whitelist processUncoveredFilesFromWhitelist="true">
            <directory suffix=".php">src</directory>
        </whitelist>
    </filter>
</phpunit>
