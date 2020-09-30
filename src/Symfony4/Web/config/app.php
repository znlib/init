<?php

use Illuminate\Container\Container;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use ZnLib\Init\Symfony4\Web\InitModule;
use ZnLib\Web\Symfony4\MicroApp\MicroApp;

$rootDir = realpath(__DIR__ . '/../../../../../../..');
require_once $rootDir . '/common/Bootstrap/autoload.php';
DotEnv::init($rootDir);

if (file_exists($rootDir . '/common/runtime/init.lock')) {
    exit('Already installed!');
}

$container = Container::getInstance();

$app = new MicroApp($container);
$app->setErrorLevel(E_ALL);
$app->addModule(new InitModule);
$response = $app->run();
$response->send();
