<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Dadamssg\DemoApp\Bundle\AppBundle\Features\Context\HttpContext;

class UserDomainContext implements Context, SnippetAcceptingContext
{
    /**
     * @var HttpContext
     */
    private $httpContext;

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        /** @var InitializedContextEnvironment $environment */
        $environment = $scope->getEnvironment();
        $this->httpContext = $environment->getContext(HttpContext::CLASS);
    }

    /**
     * @When they register with valid user data
     */
    public function theyRegisterWithValidUserData()
    {
        $data = [
            'user' => [
                'email' => 'foo@bar.com',
                'password' => 's3cr3t123',
            ]
        ];

        $this->httpContext->anAnonymousUser();

        $url = $this->httpContext->generateUrl('demo_app.user.register_user');

        $this->httpContext->submitJson('POST', $url, $data);
    }
}