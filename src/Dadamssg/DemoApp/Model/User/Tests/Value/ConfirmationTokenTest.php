<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Value;

use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;

class ConfirmationTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\AssertionFailedException
     */
    public function testCannotCreateInvalidToken()
    {
        new ConfirmationToken(123);
    }

    public function testCanCastConfirmationTokenToString()
    {
        $this->assertNotEmpty((string) new ConfirmationToken());
    }
}