<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Value;

use Dadamssg\DemoApp\Model\User\Value\Email;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testCannotCreateInvalidEmail()
    {
        new Email('foobar');
    }
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testCannotUseAnythingButString()
    {
        new Email(new \stdClass());
    }

    public function testCanCastEmailToString()
    {
        $email = new Email($e = 'foo@bar.com');
        $this->assertSame($e, (string)$email);
    }
}