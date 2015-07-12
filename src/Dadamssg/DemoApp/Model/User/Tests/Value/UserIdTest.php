<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Value;

use Dadamssg\DemoApp\Model\User\Value\UserId;
use Rhumsaa\Uuid\Uuid;

class UserIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testCannotCreateInvalidUserId()
    {
        new UserId('123');
    }
    public function testCanCastUserIdToString()
    {
        $uuid = Uuid::uuid4()->toString();
        $userId = new UserId($uuid);

        $this->assertSame($uuid, (string)$userId);
    }
}