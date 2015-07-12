<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\User\Command\ResetPassword;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Security\PasswordEncoder;
use Dadamssg\DemoApp\Model\User\Value\Salt;

class ResetPasswordHandler
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
     * @param ResetPassword $command
     */
    public function handle(ResetPassword $command)
    {
        $user = $this->users->findById($command->getUserId());

        $encodedPassword = $this->encoder->encode(
            new Salt(),
            $command->getPlainPassword()
        );

        $user->changePassword($encodedPassword);

        $this->users->add($user);
    }
}