<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Entity;

use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use DateTime;

class DoctrineUser implements User
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var DateTime
     */
    private $registeredAt;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var EncodedPassword
     */
    private $encodedPassword;

    /**
     * @var bool
     */
    private $enabled = false;

    /**
     * @param UserId $id
     * @param Email $email
     * @param EncodedPassword $encodedPassword
     */
    public function __construct(UserId $id, Email $email, EncodedPassword $encodedPassword)
    {
        $this->id = (string)$id;
        $this->registeredAt = new DateTime();
        $this->email = $email;
        $this->encodedPassword = $encodedPassword;
    }

    /**
     * @return UserId
     */
    public function getId()
    {
        return new UserId($this->id);
    }

    /**
     * @param EncodedPassword $password
     */
    public function changePassword(EncodedPassword $password)
    {
        $this->encodedPassword = $password;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled = true)
    {
        $this->enabled = (bool)$enabled;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }
}