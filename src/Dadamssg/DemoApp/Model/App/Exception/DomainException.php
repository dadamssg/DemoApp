<?php

namespace Dadamssg\DemoApp\Model\App\Exception;

class DomainException extends \RuntimeException
{
    public function __construct($message = "", $code = 400, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}