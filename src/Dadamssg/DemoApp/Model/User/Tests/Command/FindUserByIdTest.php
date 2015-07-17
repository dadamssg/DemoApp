<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Command;

use Dadamssg\DemoApp\Model\User\Command\FindUserById;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class FindUserByIdTest extends \PHPUnit_Framework_TestCase
{
    public function testItConvertsUserIdsToVOs()
    {
        $id = (string)new UserId();

        $command = new FindUserById($id, $id);

        $this->assertInstanceOf(UserId::CLASS, $command->getCurrentUserId());
        $this->assertInstanceOf(UserId::CLASS, $command->getUserId());
    }

    public function testItCanSetAndGetUser()
    {
        $id = (string)new UserId();

        $command = new FindUserById($id, $id);

        $user = $this->prophesize(User::CLASS)->reveal();
        $command->setUser($user);

        $this->assertInstanceOf(User::CLASS, $command->getUser());
    }
}