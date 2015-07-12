<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Dadamssg\DemoApp\Model\App\Data\DataClearer;

class DataContext implements Context
{
    /**
     * @var DataClearer
     */
    private $dataClearer;

    /**
     * @param DataClearer $dataClearer
     */
    public function __construct(DataClearer $dataClearer)
    {
        $this->dataClearer = $dataClearer;
    }

    /** @BeforeScenario */
    public function clearData(BeforeScenarioScope $scope)
    {
        $this->dataClearer->clear();
    }
}