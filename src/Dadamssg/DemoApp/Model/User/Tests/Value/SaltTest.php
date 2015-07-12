<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Value;

use Dadamssg\DemoApp\Model\User\Value\Salt;

class SaltTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testSaltMustBeString()
    {
        new Salt(123);
    }
    public function testSaltCanBeCastToString()
    {
        $salt = new Salt();
        $this->assertNotEmpty((string)$salt);
    }
}