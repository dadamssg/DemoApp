<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Repository;

use Dadamssg\DemoApp\Bundle\UserBundle\Entity\DoctrineUser;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Exception\UserNotFoundException;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    /**
     * {@inheritdoc}
     */
    public function createUser(UserId $id, Email $email, EncodedPassword $password, ConfirmationToken $confirmationToken)
    {
        return new DoctrineUser($id, $email, $password, $confirmationToken);
    }

    /**
     * {@inheritdoc}
     */
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findById(UserId $id)
    {
        if (null === $user =  $this->find((string)$id)) {
            throw new UserNotFoundException(sprintf('No user found by id "%s".', $id));
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function finddByConfirmationToken(ConfirmationToken $token)
    {
        if (null === $user = $this->findOneBy(['confirmationToken.value' => (string)$token])) {
            throw new UserNotFoundException(sprintf('No user found by token "%s".', $token));
        }

        return $user;
    }
}