<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Entity;

use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Event\UserRegistered;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\Role;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use DateTime;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

class DoctrineUser implements User, ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

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
     * @var ConfirmationToken
     */
    private $confirmationToken;

    /**
     * @var array
     */
    private $roles = [Role::API];

    /**
     * @param UserId $id
     * @param Email $email
     * @param EncodedPassword $encodedPassword
     * @param ConfirmationToken $confirmationToken
     */
    public function __construct(UserId $id, Email $email, EncodedPassword $encodedPassword, ConfirmationToken $confirmationToken)
    {
        $this->id = (string)$id;
        $this->registeredAt = new DateTime();
        $this->email = $email;
        $this->encodedPassword = $encodedPassword;
        $this->confirmationToken = $confirmationToken;

        $this->record(new UserRegistered($this->id));
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

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param ConfirmationToken $token
     */
    public function setConfirmationToken(ConfirmationToken $token)
    {
        $this->confirmationToken = $token;
    }

    /**
     * @return ConfirmationToken
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * @param Role $role
     */
    public function addRole(Role $role)
    {
        if (!$this->hasRole($role)) {
            $this->roles[] = (string)$role;
        }
    }

    /**
     * @param Role $role
     * @return bool
     */
    public function hasRole(Role $role)
    {
        return in_array((string)$role, $this->roles);
    }
}