<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Value;

use Dadamssg\DemoApp\Model\User\Value\PlainPassword;

class PlainPasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testPlainPasswordMustBeString()
    {
        new PlainPassword(123);
    }
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testPlainPasswordMustBeLongerThan5Characters()
    {
        new PlainPassword('12345');
    }
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testPlainPasswordMustBeShorterThan31Characters()
    {
        new PlainPassword('1234567890123456789012345678901');
    }
    public function testPlainPasswordIsValidBetween6And30Characters()
    {
        new PlainPassword("123456");
        new PlainPassword("123456789012345678901234567890");
    }
    public function testPlainPasswordCanBeCastToString()
    {
        $password = new PlainPassword($p = '12345678');

        $this->assertSame($p, (string)$password);
    }
}