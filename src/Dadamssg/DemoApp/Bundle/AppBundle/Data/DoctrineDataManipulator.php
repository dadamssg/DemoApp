<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Data;

use Dadamssg\DemoApp\Model\App\Data\DataClearer;
use Dadamssg\DemoApp\Model\App\Data\DataManipulator;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineDataManipulator implements DataManipulator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    private $dbUser;

    /**
     * @param EntityManagerInterface $em
     * @param string $dbUser
     */
    public function __construct(EntityManagerInterface $em, $dbUser)
    {
        $this->dbUser = $dbUser;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->em->getConnection()->executeQuery(sprintf("SELECT truncate_tables('%s');", $this->dbUser));
    }
}