<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Handler;

use Dadamssg\DemoApp\Model\User\Command\SendConfirmationEmail;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Handler\SendConfirmationEmailHandler;
use Dadamssg\DemoApp\Model\User\Mailer\UserMailer;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class SendConfirmationHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testItSendsUserEmaiIfNotEnabled()
    {
        /** @var UserRepository $users */
        $users = $this->prophesize(UserRepository::CLASS);
        /** @var User $user */
        $user = $this->prophesize(User::CLASS);
        /** @var UserMailer $mailer */
        $mailer = $this->prophesize(UserMailer::CLASS);
        /** @var SendConfirmationEmail $command */
        $command = $this->prophesize(SendConfirmationEmail::CLASS);
        $userId = $this->prophesize(UserId::CLASS)->reveal();

        $command->getUserId()->willReturn($userId);
        $users->findById($userId)->willReturn($user->reveal());
        $user->isEnabled()->willReturn(false);
        $mailer->sendAccountConfirmationEmail($user->reveal())->shouldBeCalled();

        $handler = new SendConfirmationEmailHandler($users->reveal(), $mailer->reveal());
        $handler->handle($command->reveal());
    }

    /**
     * @expectedException \Dadamssg\DemoApp\Model\App\Exception\DomainException
     */
    public function testItDoesNotSendsUserEmaiIfAlreadyEnabled()
    {
        /** @var UserRepository $users */
        $users = $this->prophesize(UserRepository::CLASS);
        /** @var User $user */
        $user = $this->prophesize(User::CLASS);
        /** @var UserMailer $mailer */
        $mailer = $this->prophesize(UserMailer::CLASS);
        /** @var SendConfirmationEmail $command */
        $command = $this->prophesize(SendConfirmationEmail::CLASS);
        $userId = $this->prophesize(UserId::CLASS)->reveal();

        $command->getUserId()->willReturn($userId);
        $users->findById($userId)->willReturn($user->reveal());
        $user->isEnabled()->willReturn(true);
        $mailer->sendAccountConfirmationEmail($user->reveal())->shouldNotBeCalled();

        $handler = new SendConfirmationEmailHandler($users->reveal(), $mailer->reveal());
        $handler->handle($command->reveal());
    }
}