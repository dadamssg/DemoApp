<?php

namespace Dadamssg\DemoApp\Model\User\Value;

use Dadamssg\DemoApp\Model\App\Validation\Assertion;

class Role
{
    const ADMIN = 'ROLE_ADMIN';
    const API = 'ROLE_API';

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        Assertion::string($value, "Invalid user role.");

        $this->value = strtoupper($value);
    }

    /**
     * @return static
     */
    public static function admin()
    {
        return new static(self::ADMIN);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}