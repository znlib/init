<?php

namespace ZnLib\Init\Domain\Services;

use ZnLib\Init\Domain\Interfaces\Services\LockerServiceInterface;
use ZnLib\Init\Domain\Interfaces\Repositories\LockerRepositoryInterface;
use ZnCore\Domain\Base\BaseService;

class LockerService extends BaseService implements LockerServiceInterface
{

    public function __construct(LockerRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function lock()
    {
        $this->getRepository()->lock();
    }

    public function checkLocker()
    {
        if ($this->getRepository()->isLocked()) {
            exit('Already installed!');
        }
    }
}
