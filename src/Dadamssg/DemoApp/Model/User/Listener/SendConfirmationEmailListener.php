<?php

namespace Dadamssg\DemoApp\Model\User\Listener;

use Dadamssg\DemoApp\Model\User\Command\AssignConfirmationToken;
use Dadamssg\DemoApp\Model\User\Command\SendConfirmationEmail;
use Dadamssg\DemoApp\Model\User\Event\UserRegistered;
use SimpleBus\Message\Bus\MessageBus;

class SendConfirmationEmailListener
{
    /**
     * @var MessageBus
     */
    private $commandBus;

    /**
     * @param MessageBus $commandBus
     */
    public function __construct(MessageBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param UserRegistered $event
     */
    public function notify(UserRegistered $event)
    {
        $this->commandBus->handle(new AssignConfirmationToken($event->getUserId()));
        $this->commandBus->handle(new SendConfirmationEmail($event->getUserId()));
    }
}