<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Command;

use Dadamssg\DemoApp\Model\User\Command\ResetPassword;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class ResetPasswordTest extends \PHPUnit_Framework_TestCase
{
    public function testCommandConvertsValuesToValueObjects()
    {
        $command = new ResetPassword((string)new UserId(), 's3cr3t123');

        $this->assertInstanceOf(UserId::CLASS, $command->getUserId());
        $this->assertInstanceOf(PlainPassword::CLASS, $command->getPlainPassword());
    }
}