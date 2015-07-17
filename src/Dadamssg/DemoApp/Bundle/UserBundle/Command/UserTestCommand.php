<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Command;

use Dadamssg\DemoApp\Bundle\UserBundle\Entity\DoctrineUser;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\Salt;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('demo-app:user:user-test')
            ->setDescription('Test doctrine persistence');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getContainer();

        $em = $c->get('doctrine.orm.entity_manager');
        $conn = $em->getConnection();

        $conn->beginTransaction();
        try {
            $this->persistUsers($em);
            $conn->commit();
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            $conn->rollBack();
        }

        $output->writeln("Test complete.");
    }

    private function persistUsers(EntityManagerInterface $em)
    {
        $user1 = new DoctrineUser(
            new UserId(),
            new Email('foo@bar.com'),
            new EncodedPassword(new Salt(), 'encrypted-password')
        );

        $em->persist($user1);
        $em->flush();

        $user2 = new DoctrineUser(
            new UserId(),
            new Email('foo1@bar.com'),
            new EncodedPassword(new Salt(), 'encrypted-password')
        );
        $em->persist($user2);
        $em->flush();

       // throw new \Exception("blah blah blah");
    }
}