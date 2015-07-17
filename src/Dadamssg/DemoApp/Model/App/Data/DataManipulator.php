<?php

namespace Dadamssg\DemoApp\Model\App\Data;

interface DataManipulator
{
    /**
     * Clear all data in the application.
     */
    public function clear();
}