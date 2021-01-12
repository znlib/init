<?php

use Illuminate\Container\Container;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use ZnLib\Init\Symfony4\Web\InitModule;
use ZnLib\Web\Symfony4\MicroApp\MicroApp;
use ZnCore\Base\Helpers\EnvHelper;

$rootDir = realpath(__DIR__ . '/../../../../../../..');
require_once $rootDir . '/common/Bootstrap/autoload.php';
DotEnv::init($rootDir);

$container = Container::getInstance();

$app = new MicroApp($container);
EnvHelper::showErrors();
$app->addModule(new InitModule);
$response = $app->run();
$response->send();
