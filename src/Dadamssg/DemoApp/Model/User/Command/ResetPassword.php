<?php

namespace Dadamssg\DemoApp\Model\User\Command;

use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class ResetPassword
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @param string $userId
     * @param string $plainPassword
     */
    public function __construct($userId, $plainPassword)
    {
        $this->userId = $userId;
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return new UserId($this->userId);
    }

    /**
     * @return PlainPassword
     */
    public function getPlainPassword()
    {
        return new PlainPassword($this->plainPassword);
    }
}