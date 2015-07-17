<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\User\Command\FindUserById;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;

class FindUserByIdHandler
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param FindUserById $command
     */
    public function handle(FindUserById $command)
    {
        $user = $this->users->findById($command->getUserId());

        $command->setUser($user);
    }
}