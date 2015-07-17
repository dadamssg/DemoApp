<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Command;

use Dadamssg\DemoApp\Model\User\Command\PromoteToAdmin;
use Dadamssg\DemoApp\Model\User\Command\RegisterUser;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSystemUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('demo-app:user:create-system-user')
            ->setDescription('Create the system user');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getContainer();

        $userId = $c->getParameter('system_user_id');

        $createUser = new RegisterUser(
            $userId,
            $userId,
            $c->getParameter('system_user_email'),
            $c->getParameter('system_user_password')
        );

        $this->getCommandBus()->handle($createUser);
        $this->getCommandBus()->handle(new PromoteToAdmin($userId, $userId));


        $output->writeln("Created system user.");
    }

    /**
     * @return \SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware
     */
    private function getCommandBus()
    {
        return $this->getContainer()->get('command_bus');
    }
}