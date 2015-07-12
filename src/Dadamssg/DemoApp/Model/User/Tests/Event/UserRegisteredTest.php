<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Event;

use Dadamssg\DemoApp\Model\User\Event\UserRegistered;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class UserRegisteredTest extends \PHPUnit_Framework_TestCase
{
    public function testEventConvertsDataToValueObjects()
    {
        $event = new UserRegistered((string) new UserId());

        $this->assertInstanceOf(UserId::CLASS, $event->getUserId());
    }
}