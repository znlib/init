<?php

namespace ZnLib\Init\Domain\Repositories\File;

use ZnLib\Init\Domain\Entities\RequirementEntity;
use ZnLib\Init\Domain\Interfaces\Repositories\RequirementRepositoryInterface;

class RequirementRepository implements RequirementRepositoryInterface
{
    /*public function getEntityClass() : string
    {
        return RequirementEntity::class;
    }*/

    public function all() {
        $requirements = [];
        $arr = explode(',', $_ENV['REQUIREMENT_CONFIG']);
        foreach ($arr as $item) {
            $itemRequirements = include($this->fileName($item));
            $requirements = array_merge($requirements, $itemRequirements);
        }
        return $requirements;
    }

    private function fileName(string $name) : string
    {
        $rootDir = realpath(__DIR__ . '/../../../../../../..');
        return $rootDir . '/' . $name;
    }

}
