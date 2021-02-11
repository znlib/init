<?php

namespace ZnLib\Init\Domain\Services;

use YiiRequirementChecker;
use ZnCore\Domain\Base\BaseService;
use ZnLib\Init\Domain\Helpers\RequirementHelper;
use ZnLib\Init\Domain\Interfaces\Repositories\RequirementRepositoryInterface;
use ZnLib\Init\Domain\Interfaces\Services\RequirementServiceInterface;

class RequirementService extends BaseService implements RequirementServiceInterface
{

    private $requirementChecker;

    public function __construct(RequirementRepositoryInterface $repository, YiiRequirementChecker $requirementChecker)
    {
        $this->setRepository($repository);
        $this->requirementChecker = $requirementChecker;
    }

    public function checkRequirements(): array
    {
        $requirements = $this->getRepository()->all();
        $result = RequirementHelper::check($requirements);
        return $result;
    }
}
