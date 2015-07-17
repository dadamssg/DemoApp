<?php

namespace Dadamssg\DemoApp\Model\User\Value;

use Dadamssg\DemoApp\Model\App\Validation\Assertion;

class Email
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $canonicalValue;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        Assertion::email($value, "Invalid user email.");

        $this->value = $value;
        $this->canonicalValue = self::canonicalize($value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return string
     */
    public static function canonicalize($value)
    {
        return strtolower((string)$value);
    }
}