<?php

namespace Dadamssg\DemoApp\Model\User\Command;

use Dadamssg\DemoApp\Model\App\Validation\HasErrors;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class RegisterUser
{
    use HasErrors;

    /**
     * @var string
     */
    private $currentUserId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @param string $currentUserId
     * @param string $userId
     * @param string $email
     * @param string $plainPassword
     */
    public function __construct($currentUserId, $userId, $email, $plainPassword)
    {
        $this->currentUserId = (string)$currentUserId;
        $this->userId = (string)$userId;
        $this->email = (string)$email;
        $this->plainPassword = (string)$plainPassword;
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

    /**
     * @return Email
     */
    public function getEmail()
    {
        return new Email($this->email);
    }

    /**
     * @return PlainPassword
     */
    public function getPlainPassword()
    {
        return new PlainPassword($this->plainPassword);
    }
}