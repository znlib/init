<?php

namespace ZnLib\Init\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnCore\Domain\Interfaces\Entity\ValidateEntityByMetadataInterface;

class LockerEntity implements ValidateEntityByMetadataInterface
{

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {

    }

}
