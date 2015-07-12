<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Data;

use Dadamssg\DemoApp\Model\App\Data\DataClearer;
use Doctrine\DBAL\Connection;

class PostgresDataClearer implements DataClearer
{
    /**
     * @var Connection
     */
    private $conn;

    /**
     * @var string
     */
    private $dbUser;

    /**
     * @param Connection $conn
     * @param string $dbUser
     */
    public function __construct(Connection $conn, $dbUser)
    {
        $this->conn = $conn;
        $this->dbUser = $dbUser;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->conn->executeQuery(sprintf("SELECT truncate_tables('%s');", $this->dbUser));
    }
}