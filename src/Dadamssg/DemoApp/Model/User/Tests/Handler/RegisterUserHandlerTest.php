<?php

namespace Dadamssg\DemoApp\Model\User\Tests\Handler;

use Dadamssg\DemoApp\Model\User\Command\RegisterUser;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Handler\RegisterUserHandler;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Security\PasswordEncoder;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use Dadamssg\DemoApp\Model\User\Value\Salt;
use Prophecy\Argument;

class RegisterUserHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testItRegistersUser()
    {
        /** @var UserRepository $users */
        $users = $this->prophesize(UserRepository::CLASS);
        /** @var User $user */
        $user = $this->prophesize(User::CLASS);
        /** @var PasswordEncoder $encoder */
        $encoder = $this->prophesize(PasswordEncoder::CLASS);
        /** @var RegisterUser $command */
        $command = $this->prophesize(RegisterUser::CLASS);
        $command->getUserId()->willReturn($id = $this->prophesize(UserId::CLASS)->reveal());
        $command->getEmail()->willReturn($email = $this->prophesize(Email::CLASS)->reveal());
        $command->getPlainPassword()->willReturn($plainPassword = $this->prophesize(PlainPassword::CLASS)->reveal());

        $saltType = Argument::type(Salt::CLASS);
        $encodedPassword = $this->prophesize(EncodedPassword::CLASS)->reveal();
        $encoder->encode($saltType, $plainPassword)->willReturn($encodedPassword);

        $users->createUser($id, $email, $encodedPassword, Argument::type(ConfirmationToken::CLASS))->willReturn($user);
        $users->add($user)->shouldBeCalled();

        $handler = new RegisterUserHandler($users->reveal(), $encoder->reveal());
        $handler->handle($command->reveal());
    }
}