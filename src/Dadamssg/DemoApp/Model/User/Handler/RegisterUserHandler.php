<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\User\Command\RegisterUser;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Security\PasswordEncoder;
use Dadamssg\DemoApp\Model\User\Value\Salt;

class RegisterUserHandler
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var PasswordEncoder
     */
    private $encoder;

    /**
     * @param UserRepository $users
     * @param PasswordEncoder $encoder
     */
    public function __construct(UserRepository $users, PasswordEncoder $encoder)
    {
        $this->users = $users;
        $this->encoder = $encoder;
    }

    /**
     * @param RegisterUser $command
     */
    public function handle(RegisterUser $command)
    {
        $encodedPassword = $this->encoder->encode(
            new Salt(),
            $command->getPlainPassword()
        );

        $user = $this->users->createUser(
            $command->getUserId(),
            $command->getEmail(),
            $encodedPassword
        );

        $this->users->add($user);
    }
}