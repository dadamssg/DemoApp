<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Repository;

use Dadamssg\DemoApp\Bundle\UserBundle\Entity\DoctrineUser;
use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    /**
     * {@inheritdoc}
     */
    public function createUser(UserId $id, Email $email, EncodedPassword $password)
    {
        return new DoctrineUser($id, $email, $password);
    }

    /**
     * {@inheritdoc}
     */
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
    }

    /**
     * {@inheritdoc}
     */
    public function findById(UserId $id)
    {
        return $this->find((string)$id);
    }
}