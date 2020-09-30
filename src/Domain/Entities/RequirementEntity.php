<?php

namespace ZnLib\Init\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use ZnCore\Domain\Interfaces\Entity\ValidateEntityInterface;

class RequirementEntity implements ValidateEntityInterface
{

    private $name = null;

    private $mandatory = null;

    private $condition = null;

    private $by = null;

    private $memo = null;

    public function validationRules()
    {
        return [
            'name' => [
                new Assert\NotBlank,
            ],
            'mandatory' => [
                new Assert\NotBlank,
            ],
            'condition' => [
                new Assert\NotBlank,
            ],
            'by' => [
                new Assert\NotBlank,
            ],
            'memo' => [
                new Assert\NotBlank,
            ],
        ];
    }

    public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setMandatory($value) : void
    {
        $this->mandatory = $value;
    }

    public function getMandatory()
    {
        return $this->mandatory;
    }

    public function setCondition($value) : void
    {
        $this->condition = $value;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function setBy($value) : void
    {
        $this->by = $value;
    }

    public function getBy()
    {
        return $this->by;
    }

    public function setMemo($value) : void
    {
        $this->memo = $value;
    }

    public function getMemo()
    {
        return $this->memo;
    }


}

