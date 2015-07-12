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
        $command = new RegisterUser((string)new UserId(), 'foo@bar.com', 's3cr3t123');

        $this->assertInstanceOf(UserId::CLASS, $command->getUserId());
        $this->assertInstanceOf(Email::CLASS, $command->getEmail());
        $this->assertInstanceOf(PlainPassword::CLASS, $command->getPlainPassword());
    }
}