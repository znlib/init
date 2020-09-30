<?php

namespace ZnLib\Init\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnCore\Domain\Helpers\EntityHelper;
use ZnLib\Fixture\Domain\Services\FixtureService;
use ZnLib\Migration\Domain\Entities\MigrationEntity;
use ZnLib\Migration\Domain\Services\MigrationService;
use ZnLib\Rest\Web\Controller\BaseCrudWebController;
use ZnLib\Web\Symfony4\MicroApp\BaseWebController;

class InitController extends BaseWebController
{

    protected $viewsDir = __DIR__ . '/../views/init';

    private $fixtureService;
    private $migrationService;

    public function __construct(MigrationService $migrationService, FixtureService $fixtureService)
    {
        $this->fixtureService = $fixtureService;
        $this->migrationService = $migrationService;
    }

    public function index(Request $request): Response
    {
        return $this->renderTemplate('index', []);
    }

    public function env(Request $request): Response
    {
        return $this->renderTemplate('env', []);
    }

    public function install(Request $request): Response
    {
        $initResult = shell_exec('cd ../.. && php init --env=Development --overwrite=All');

        //dd($_POST);
        /** @var MigrationEntity[] $migrationCollection */
        $migrationCollection = $this->migrationService->allForUp();

        $migrationNames = [];
        if ($migrationCollection) {
            foreach ($migrationCollection as $migrationEntity) {
                $this->migrationService->upMigration($migrationEntity);
                $migrationNames[] = $migrationEntity->className;
            }
        }

        $all = $this->fixtureService->allTables();
        if ($all->count()) {
            $fixtureNames = EntityHelper::getColumn($all, 'name');
            $this->fixtureService->importAll($fixtureNames);
        }

        touch(__DIR__ . '/../../../../../../../common/runtime/init.lock');

        return $this->renderTemplate('install', [
            'initResult' => $initResult,
            'migrationNames' => $migrationNames,
            'fixtureNames' => $fixtureNames,
        ]);
    }
}
