<?php

namespace Dadamssg\DemoApp\Model\User\Event;

use Dadamssg\DemoApp\Model\User\Value\UserId;

final class UserRegistered
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