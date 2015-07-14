<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\User\Command\AssignConfirmationToken;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;

class AssignConfirmationTokenHandler
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
     * @param AssignConfirmationToken $command
     */
    public function handle(AssignConfirmationToken $command)
    {
        $user = $this->users->findById($command->getUserId());

        $user->setConfirmationToken(new ConfirmationToken());

        $this->users->add($user);
    }
}