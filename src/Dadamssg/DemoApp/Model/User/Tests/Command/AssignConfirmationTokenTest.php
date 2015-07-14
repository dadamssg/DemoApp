<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Command;

use Dadamssg\DemoApp\Model\User\Command\AssignConfirmationToken;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class AssignConfirmationTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testItConvertsUserIdToVO()
    {
        $id = (string)new UserId();

        $command = new AssignConfirmationToken($id);

        $this->assertInstanceOf(UserId::CLASS, $command->getUserId());
    }
}