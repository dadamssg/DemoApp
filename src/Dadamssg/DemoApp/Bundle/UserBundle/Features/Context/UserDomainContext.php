<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Dadamssg\DemoApp\Bundle\AppBundle\Features\Context\HttpContext;
use Dadamssg\DemoApp\Model\User\Repository\UserRepository;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\Salt;
use Dadamssg\DemoApp\Model\User\Value\UserId;

class UserDomainContext implements Context, SnippetAcceptingContext
{
    /**
     * @var HttpContext
     */
    private $httpContext;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

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

        $this->httpContext->isJsonRequest();
        $this->httpContext->setJsonPayload($data);
        $this->httpContext->post($url);
    }

    /**
     * @When they visit a valid user confirmation link
     */
    public function theyVisitAValidUserConfirmationLink()
    {
        $user = $this->users->createUser(
            new UserId(),
            new Email('foo@bar.com'),
            new EncodedPassword(new Salt(), 'encrypted-password'),
            new ConfirmationToken()
        );

        $this->users->add($user);

        $url = $this->httpContext->generateUrl(
            'demo_app.user.enable_user',
            ['token' => (string)$user->getConfirmationToken()]
        );

        $this->httpContext->isJsonRequest();
        $this->httpContext->get($url);
    }
}