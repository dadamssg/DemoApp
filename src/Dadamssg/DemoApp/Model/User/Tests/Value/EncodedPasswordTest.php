<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Value;

use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\Salt;

class EncodedPasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testEncodedPasswordMustBeAString()
    {
        new EncodedPassword(new Salt(), 123);
    }
    public function testCanCastEncodedPasswordToString()
    {
        $password = new EncodedPassword(new Salt(), $p = "dsgio323jkdg43gsdgsajkgsdg");
        $this->assertSame($p, (string)$password);
    }
}