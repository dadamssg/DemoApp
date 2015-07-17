<?php

namespace Dadamssg\DemoApp\Model\App\Data;

abstract class TransactionManager
{
    abstract public function begin();

    abstract public function commit();

    abstract public function rollback();

    public function transactional(callable $callable)
    {
        $this->begin();

        try {
            $callable();
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw $e;
        }
    }
}