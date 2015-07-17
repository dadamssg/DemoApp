<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Data;

use Dadamssg\DemoApp\Model\App\Data\DataManipulator;
use Dadamssg\DemoApp\Model\User\Command\FindUserById;
use Dadamssg\DemoApp\Model\User\Command\RegisterUser;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Security\PasswordEncoder;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\Salt;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use SimpleBus\Message\Bus\MessageBus;

class UserManipulator
{
    /**
     * @var DataManipulator
     */
    private $data;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var PasswordEncoder
     */
    private $encoder;

    /**
     * @var array
     */
    private $systemUserData;

    /**
     * @param DataManipulator $data
     * @param UserRepository|MessageBus $users
     * @param PasswordEncoder $encoder
     * @param array $systemUserData
     */
    public function __construct(DataManipulator $data, UserRepository $users, PasswordEncoder $encoder, $systemUserData)
    {
        $this->data = $data;
        $this->users = $users;
        $this->encoder = $encoder;
        $this->systemUserData = $systemUserData;
    }

    /**
     * @return User
     */
    public function createSystemUser()
    {
        $plainPassword = new PlainPassword($this->systemUserData['system_user_password']);
        $encodedPassword = $this->encoder->encode(new Salt(), $plainPassword);

        $user = $this->users->createUser(
            new UserId($this->systemUserData['system_user_id']),
            new Email($this->systemUserData['system_user_email']),
            $encodedPassword
        );

        $user->setEnabled(true);

        $this->users->add($user);
        $this->data->commit();
    }
}