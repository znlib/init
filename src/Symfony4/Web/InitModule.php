<?php

namespace ZnLib\Init\Symfony4\Web;

use Illuminate\Container\Container;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use ZnLib\Init\Symfony4\Web\Controllers\InitController;
use ZnLib\Web\Symfony4\MicroApp\BaseModule;

class InitModule extends BaseModule
{

    public function configContainer(Container $container) {
        $container->bind(FileRepository::class, function () {
            $eloquentConfigFile = $_ENV['ELOQUENT_CONFIG_FILE'];
            return new FileRepository($eloquentConfigFile);
        });
        $container->bind(SourceRepository::class, function () {
            $eloquentConfigFile = $_ENV['ELOQUENT_CONFIG_FILE'];
            return new SourceRepository($eloquentConfigFile);
        });
    }

    public function configRoutes(RouteCollection $routes)
    {
        $routes->add('init_index', new Route('/', [
            '_controller' => InitController::class,
            '_action' => 'index',
        ]));
        $routes->add('init_env', new Route('/env', [
            '_controller' => InitController::class,
            '_action' => 'env',
        ]));
        $routes->add('init_install', new Route('/install', [
            '_controller' => InitController::class,
            '_action' => 'install',
        ]));
    }
}
