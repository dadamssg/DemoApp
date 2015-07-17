<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\User\Command\ResendConfirmationEmail;
use Dadamssg\DemoApp\Model\User\Mailer\UserMailer;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;

class ResendConfirmationEmailHandler
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * @param UserRepository $users
     * @param UserMailer $mailer
     */
    public function __construct(UserRepository $users, UserMailer $mailer)
    {
        $this->users = $users;
        $this->mailer = $mailer;
    }

    /**
     * @param ResendConfirmationEmail $command
     */
    public function handle(ResendConfirmationEmail $command)
    {
        $user = $this->users->findById($command->getUserId());
        $user->setConfirmationToken(new ConfirmationToken());

        $this->users->add($user);

        $this->mailer->sendAccountConfirmationEmail($user);
    }
}