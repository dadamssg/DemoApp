<?php

namespace Dadamssg\DemoApp\Model\User\Command;

use Dadamssg\DemoApp\Model\User\Value\UserId;

class SendConfirmationEmail
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @param string $userId
     */
    public function __construct($userId)
    {
        $this->userId = (string)$userId;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return new UserId($this->userId);
    }
}