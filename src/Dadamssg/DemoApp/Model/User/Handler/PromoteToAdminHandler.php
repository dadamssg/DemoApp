<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\User\Command\PromoteToAdmin;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\Role;

class PromoteToAdminHandler
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
     * @param PromoteToAdmin $command
     */
    public function handle(PromoteToAdmin $command)
    {
        $user = $this->users->findById($command->getUserId());

        $user->addRole(Role::admin());

        $this->users->add($user);
    }
}