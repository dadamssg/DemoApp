<?php

namespace Dadamssg\DemoApp\Model\User\Value;

use Dadamssg\DemoApp\Model\App\Validation\Assertion;
use Rhumsaa\Uuid\Uuid;

final class UserId
{
    /**
     * @var null|string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value = null)
    {
        $value = $value ?: Uuid::uuid4()->toString();

        Assertion::uuid($value, "Invalid user id.");

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