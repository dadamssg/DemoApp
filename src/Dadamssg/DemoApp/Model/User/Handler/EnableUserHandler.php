<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\User\Command\EnableUser;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;

class EnableUserHandler
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
     * @param EnableUser $command
     */
    public function handle(EnableUser $command)
    {
        $user = $this->users->finddByConfirmationToken($command->getConfirmationToken());

        $user->setEnabled(true);

        $this->users->add($user);
    }
}