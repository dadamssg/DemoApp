<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Dadamssg\DemoApp\Model\App\Data\DataClearer;
use Dadamssg\DemoApp\Model\App\Data\DataManipulator;

class DataContext implements Context
{
    /**
     * @var DataManipulator
     */
    private $data;

    /**
     * @param DataClearer $data
     */
    public function __construct(DataManipulator $data)
    {
        $this->data = $data;
    }

    /** @BeforeScenario */
    public function clearData(BeforeScenarioScope $scope)
    {
        $this->data->clear();
    }
}