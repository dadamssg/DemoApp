<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Data;

use Dadamssg\DemoApp\Model\App\Data\TransactionManager;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTransactionManager extends TransactionManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function begin()
    {
        $this->em->getConnection()->beginTransaction();
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        $this->em->getConnection()->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function rollback()
    {
        $this->em->close();
        $this->em->getConnection()->rollBack();
    }
}