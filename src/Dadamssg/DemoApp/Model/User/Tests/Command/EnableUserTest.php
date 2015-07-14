<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Command;

use Dadamssg\DemoApp\Model\User\Command\EnableUser;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;

class EnableUserTest extends \PHPUnit_Framework_TestCase
{
    public function testItConvertsTokenToVO()
    {
        $command = new EnableUser('lsdkjgsd0g8sgoisj237dhgadg7dsgg2332dgs');

        $this->assertInstanceOf(ConfirmationToken::CLASS, $command->getConfirmationToken());
    }
}