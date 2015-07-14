<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Handler;

use Dadamssg\DemoApp\Model\User\Command\AssignConfirmationToken;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Handler\AssignConfirmationTokenHandler;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use Prophecy\Argument;

class AssignConfirmationTokenHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testItAssignsNewTokenToUser()
    {
        /** @var UserRepository $users */
        $users = $this->prophesize(UserRepository::CLASS);
        /** @var User $user */
        $user = $this->prophesize(User::CLASS);
        /** @var AssignConfirmationToken $command */
        $command = $this->prophesize(AssignConfirmationToken::CLASS);
        $userId = $this->prophesize(UserId::CLASS)->reveal();

        $command->getUserId()->willReturn($userId);
        $users->findById($userId)->willReturn($user->reveal());
        $user->setConfirmationToken(Argument::type(ConfirmationToken::CLASS))->shouldBeCalled();
        $users->add($user->reveal())->shouldBeCalled();

        $handler = new AssignConfirmationTokenHandler($users->reveal());
        $handler->handle($command->reveal());
    }
}