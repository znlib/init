<?php

namespace ZnLib\Init\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnCore\Domain\Helpers\EntityHelper;
use ZnLib\Fixture\Domain\Services\FixtureService;
use ZnLib\Init\Domain\Services\LockerService;
use ZnLib\Init\Domain\Services\RequirementService;
use ZnLib\Migration\Domain\Entities\MigrationEntity;
use ZnLib\Migration\Domain\Services\MigrationService;
use ZnLib\Rest\Web\Controller\BaseCrudWebController;
use ZnLib\Web\Symfony4\MicroApp\BaseWebController;

class InitController extends BaseWebController
{

    protected $viewsDir = __DIR__ . '/../views/init';

    private $fixtureService;
    private $migrationService;
    private $lockerService;
    private $requirementService;

    public function __construct(
        MigrationService $migrationService,
        FixtureService $fixtureService,
        LockerService $lockerService,
        RequirementService $requirementService
    )
    {
        $this->fixtureService = $fixtureService;
        $this->migrationService = $migrationService;
        $this->lockerService = $lockerService;
        $this->requirementService = $requirementService;
        $this->lockerService->checkLocker();
    }

    public function index(Request $request): Response
    {
        $result = $this->requirementService->checkRequirements();
        return $this->renderTemplate('index', $result);
    }

    public function env(Request $request): Response
    {
        return $this->renderTemplate('env', []);
    }

    public function install(Request $request): Response
    {
        $initResult = $this->initApp();
        $migrationNames = $this->upMigrations();
        $fixtureNames = $this->importFixtures();
        $this->lockerService->lock();

        return $this->renderTemplate('install', [
            'initResult' => $initResult,
            'migrationNames' => $migrationNames,
            'fixtureNames' => $fixtureNames,
        ]);
    }

    private function initApp()
    {
        $initResult = shell_exec('cd ../.. && php init --env=Development --overwrite=All');
        return $initResult;
    }

    private function importFixtures(): array
    {
        $all = $this->fixtureService->allTables();
        $fixtureNames = [];
        if ($all->count()) {
            $fixtureNames = EntityHelper::getColumn($all, 'name');
            $this->fixtureService->importAll($fixtureNames);
        }
        return $fixtureNames;
    }

    private function upMigrations(): array
    {
        /** @var MigrationEntity[] $migrationCollection */
        $migrationCollection = $this->migrationService->allForUp();
        $migrationNames = [];
        if ($migrationCollection) {
            foreach ($migrationCollection as $migrationEntity) {
                $this->migrationService->upMigration($migrationEntity);
                $migrationNames[] = $migrationEntity->className;
            }
        }
        return $migrationNames;
    }
}
