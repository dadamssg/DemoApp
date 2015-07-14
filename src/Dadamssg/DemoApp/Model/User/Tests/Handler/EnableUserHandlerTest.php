<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Handler;

use Dadamssg\DemoApp\Model\User\Command\EnableUser;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Handler\EnableUserHandler;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;

class EnableUserHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testItEnablesUser()
    {
        /** @var UserRepository $users */
        $users = $this->prophesize(UserRepository::CLASS);
        /** @var User $user */
        $user = $this->prophesize(User::CLASS);
        /** @var EnableUser $command */
        $command = $this->prophesize(EnableUser::CLASS);
        $token = $this->prophesize(ConfirmationToken::CLASS)->reveal();

        $command->getConfirmationToken()->willReturn($token);
        $users->finddByConfirmationToken($token)->willReturn($user->reveal());
        $user->setEnabled(true)->shouldBeCalled();
        $users->add($user->reveal())->shouldBeCalled();

        $handler = new EnableUserHandler($users->reveal());
        $handler->handle($command->reveal());
    }
}