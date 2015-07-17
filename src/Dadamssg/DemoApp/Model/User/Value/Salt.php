<?php

namespace Dadamssg\DemoApp\Model\User\Value;

use Dadamssg\DemoApp\Model\App\Validation\Assertion;

final class Salt
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value = null)
    {
        $value = $value ?: base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);

        Assertion::string($value, "Invalid salt.");
        Assertion::minLength($value, 20, "Salt must be greater than 30 characters long.");

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}