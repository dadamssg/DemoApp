<?php

namespace Dadamssg\DemoApp\Model\User\Command;

use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;

class EnableUser
{
    /**
     * @var string
     */
    private $confirmationToken;

    /**
     * @param string $confirmationToken
     */
    public function __construct($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * @return ConfirmationToken
     */
    public function getConfirmationToken()
    {
        return new ConfirmationToken($this->confirmationToken);
    }
}