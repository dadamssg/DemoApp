<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Handler;

use Dadamssg\DemoApp\Model\User\Command\ResetPassword;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Handler\ResetPasswordHandler;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Security\PasswordEncoder;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\Salt;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use Prophecy\Argument;

class ResetPasswordHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanResetUsersPassword()
    {
        /** @var UserRepository $users */
        $users = $this->prophesize(UserRepository::CLASS);
        /** @var User $user */
        $user = $this->prophesize(User::CLASS);
        /** @var PasswordEncoder $encoder */
        $encoder = $this->prophesize(PasswordEncoder::CLASS);
        /** @var ResetPassword $command */
        $command = $this->prophesize(ResetPassword::CLASS);
        $command->getUserId()->willReturn($id = new UserId());
        $command->getPlainPassword()->willReturn($plainPassword = new PlainPassword('s3cr3t123'));

        $saltType = Argument::type(Salt::CLASS);
        $encodedPassword = new EncodedPassword(new Salt(), 'encoded-foobar123');
        $encoder->encode($saltType, $plainPassword)->willReturn($encodedPassword);

        $user->changePassword($encodedPassword)->shouldBeCalled();

        $users->findById($id)->willReturn($user);
        $users->add($user)->shouldBeCalled();

        $handler = new ResetPasswordHandler($users->reveal(), $encoder->reveal());
        $handler->handle($command->reveal());
    }
}