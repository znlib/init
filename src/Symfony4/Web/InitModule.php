<?php

namespace ZnLib\Init\Symfony4\Web;

use Illuminate\Container\Container;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use ZnLib\Init\Domain\Interfaces\Repositories\LockerRepositoryInterface;
use ZnLib\Init\Domain\Interfaces\Repositories\RequirementRepositoryInterface;
use ZnLib\Init\Domain\Repositories\File\LockerRepository;
use ZnLib\Init\Domain\Repositories\File\RequirementRepository;
use ZnLib\Init\Symfony4\Web\Controllers\InitController;
use ZnLib\Web\Symfony4\MicroApp\BaseModule;

class InitModule extends BaseModule
{

    public function configContainer(Container $container)
    {
        require_once __DIR__ . '/../../../../../../vendor/yiisoft/yii2/requirements/YiiRequirementChecker.php';
        $container->bind(LockerRepositoryInterface::class, LockerRepository::class);
        $container->bind(RequirementRepositoryInterface::class, RequirementRepository::class);
        $container->bind(FileRepository::class, function () {
            return new FileRepository($_ENV['ELOQUENT_CONFIG_FILE']);
        });
        $container->bind(SourceRepository::class, function () {
            return new SourceRepository($_ENV['ELOQUENT_CONFIG_FILE']);
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
