<?php

namespace Dadamssg\DemoApp\Model\App\Validation;

interface Validator
{
    /**
     * @param mixed $value
     * @return Error[]
     */
    public function validate($value);
}