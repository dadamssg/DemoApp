<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Value;

use Dadamssg\DemoApp\Model\User\Value\Username;

class UsernameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testUsernameMustBeString()
    {
        new Username(123);
    }
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testUsernameMustBeLongerThan3Characters()
    {
        new Username('123');
    }
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testUsernameMustBeShorterThan21Characters()
    {
        new Username('123456789012345678901');
    }
    public function testUsernameIsValidBetween4And20Characters()
    {
        new Username("1234");
        new Username('12345678901234567890');
    }
    public function testUsernameCanBeCastToString()
    {
        $username = new Username($u = "foobar");

        $this->assertSame($u, (string)$username);
    }
}