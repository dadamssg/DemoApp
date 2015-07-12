<?php

namespace Dadamssg\DemoApp\Model\App\Validation;

use Assert\Assertion as BaseAssertion;
use Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException;

class Assertion extends BaseAssertion
{
    protected static $exceptionClass = AssertionFailedException::CLASS;
}