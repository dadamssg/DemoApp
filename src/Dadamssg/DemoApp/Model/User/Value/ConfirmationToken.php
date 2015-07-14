<?php

namespace Dadamssg\DemoApp\Model\User\Value;

use Dadamssg\DemoApp\Model\App\Validation\Assertion;

class ConfirmationToken
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
        $value = $value ?: $this->generateToken();

        Assertion::string($value, "Invalid confirmation token.");
        Assertion::minLength($value, 36, "Confirmation token too short.");

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function generateToken()
    {
        return rtrim(strtr(base64_encode($this->getRandomNumber()), '+/', '-_'), '=');
    }

    /**
     * @return string
     */
    private function getRandomNumber()
    {
        // try OpenSSL
        if (function_exists('openssl_random_pseudo_bytes')) {
            $nbBytes = 32;
            $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);

            if (false !== $bytes && true === $strong) {
                return $bytes;
            }
        }

        return hash('sha256', uniqid(mt_rand(), true), true);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}