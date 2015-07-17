<?php

namespace Dadamssg\DemoApp\Model\User\Listener;

use Dadamssg\DemoApp\Model\User\Event\UserRegistered;
use Dadamssg\DemoApp\Model\User\Mailer\UserMailer;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;

class SendConfirmationEmailListener
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
     * @param UserRegistered $event
     */
    public function notify(UserRegistered $event)
    {
        $user = $this->users->findById($event->getUserId());

        $this->mailer->sendAccountConfirmationEmail($user);
    }
}