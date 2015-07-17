<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Handler;

use Dadamssg\DemoApp\Model\User\Command\FindUserById;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Handler\FindUserByIdHandler;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class FindUserByIdHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testISetsUserIntoCommand()
    {
        /** @var UserRepository $users */
        $users = $this->prophesize(UserRepository::CLASS);
        $user = $this->prophesize(User::CLASS)->reveal();
        /** @var FindUserById $command */
        $command = $this->prophesize(FindUserById::CLASS);

        $userId = $this->prophesize(UserId::CLASS)->reveal();
        $command->getUserId()->willReturn($userId);

        $users->findById($userId)->willReturn($user);
        $command->setUser($user)->shouldBeCalled();

        $handler = new FindUserByIdHandler($users->reveal());
        $handler->handle($command->reveal());
    }
}