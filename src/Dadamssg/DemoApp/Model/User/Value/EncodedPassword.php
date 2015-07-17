<?php

namespace Dadamssg\DemoApp\Model\User\Value;

use Dadamssg\DemoApp\Model\App\Validation\Assertion;

class EncodedPassword
{
    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $password;

    /**
     * @param Salt $salt
     * @param string $password
     */
    public function __construct(Salt $salt, $password)
    {
        Assertion::string($password, "Invalid encoded password.");

        $this->salt = (string)$salt;
        $this->password = $password;
    }

    /**
     * @return Salt
     */
    public function getSalt()
    {
        return new Salt($this->salt);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->password;
    }
}