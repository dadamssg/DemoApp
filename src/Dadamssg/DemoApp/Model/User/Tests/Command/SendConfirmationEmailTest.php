<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Command;

use Dadamssg\DemoApp\Model\User\Command\SendConfirmationEmail;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class SendConfirmationEmailTest extends \PHPUnit_Framework_TestCase
{
    public function testItConvertsUserIdToVO()
    {
        $userId =(string)new UserId();

        $command = new SendConfirmationEmail($userId, $userId);

        $this->assertInstanceOf(UserId::CLASS, $command->getUserId());
    }
}