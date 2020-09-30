<?php

namespace ZnLib\Init\Domain\Repositories\File;

use ZnLib\Init\Domain\Entities\LockerEntity;
use ZnLib\Init\Domain\Interfaces\Repositories\LockerRepositoryInterface;

class LockerRepository implements LockerRepositoryInterface
{

    public function lock()
    {
        touch(__DIR__ . '/../../../../../../../' . $_ENV['INIT_LOCKER_FILE']);
    }

    public function isLocked(): bool
    {
        $rootDir = realpath(__DIR__ . '/../../../../../../..');
        return file_exists($rootDir . '/' . $_ENV['INIT_LOCKER_FILE']);
    }
}
