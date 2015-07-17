<?php

namespace Dadamssg\DemoApp\Model\User\Command;

use Dadamssg\DemoApp\Model\User\Value\UserId;

class ResendConfirmationEmail
{
    /**
     * @var string
     */
    private $currentUserId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @param string $currentUserId
     * @param string $userId
     */
    public function __construct($currentUserId, $userId)
    {
        $this->currentUserId = $currentUserId;
        $this->userId = $userId;
    }

    /**
     * @return UserId
     */
    public function getCurrentUserId()
    {
        return new UserId($this->currentUserId);
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return new UserId($this->userId);
    }
}