<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Command;

use Dadamssg\DemoApp\Model\User\Command\RegisterUser;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class RegisterUserTest extends \PHPUnit_Framework_TestCase
{
    public function testCommandConvertsValuesToValueObjects()
    {
        $userId = (string)new UserId();
        $command = new RegisterUser($userId, $userId, 'foo@bar.com', 's3cr3t123');

        $this->assertInstanceOf(UserId::CLASS, $command->getCurrentUserId());
        $this->assertInstanceOf(UserId::CLASS, $command->getUserId());
        $this->assertInstanceOf(Email::CLASS, $command->getEmail());
        $this->assertInstanceOf(PlainPassword::CLASS, $command->getPlainPassword());
    }
}