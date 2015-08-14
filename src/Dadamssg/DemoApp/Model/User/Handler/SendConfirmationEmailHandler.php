<?php

namespace Dadamssg\DemoApp\Model\User\Handler;

use Dadamssg\DemoApp\Model\App\Exception\DomainException;
use Dadamssg\DemoApp\Model\User\Command\SendConfirmationEmail;
use Dadamssg\DemoApp\Model\User\Mailer\UserMailer;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;

class SendConfirmationEmailHandler
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
     * @param SendConfirmationEmail $command
     */
    public function handle(SendConfirmationEmail $command)
    {
        $user = $this->users->findById($command->getUserId());

        if ($user->isEnabled()) {
            throw new DomainException("User account is already confirmed.");
        }

        $this->mailer->sendAccountConfirmationEmail($user);
    }
}
