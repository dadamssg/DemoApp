<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Features\Context;

use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HttpContext implements KernelAwareContext
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array
     */
    private $data = null;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers = [])
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data = [])
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        $this->client = $this->kernel->getContainer()->get('test.client');

        return $this->client;
    }

    public function isJsonRequest()
    {
        $this->headers['Content-Type'] = 'application/json';
        $this->headers['Accept'] = 'application/json';
    }

    public function setJsonPayload(array $data)
    {
        $this->headers['Content-Type'] = 'application/json';
        $this->data = json_encode($data);
    }

    /**
     * @param string $url
     */
    public function get($url)
    {
        $this->sendRequest('GET', $url);
    }

    /**
     * @param string $url
     */
    public function post($url)
    {
        $this->sendRequest('POST', $url);
    }

    /**
     * @param string $url
     */
    public function put($url)
    {
        $this->sendRequest('PUT', $url);
    }

    /**
     * @param string $url
     */
    public function delete($url)
    {
        $this->sendRequest('DELETE', $url);
    }

    private function sendRequest($method, $url)
    {
        $this->getHttpClient()->request(
            $method,
            $url,
            [],
            [],
            $this->headers,
            $this->data
        );

        $this->headers = [];
        $this->data = null;
    }

    /**
     * @param $route
     * @param array $params
     * @return string
     */
    public function generateUrl($route, array $params = [])
    {
        return $this->urlGenerator->generate($route, $params);
    }

    /**
     * @return array
     */
    protected function getResponseJson()
    {
        $data = $this->client->getResponse()->getContent();

        echo $data;

        return json_decode($data, true);
    }

    /**
     * @Then they get a :expectedStatusCode status code
     */
    public function theyGetAStatusCode($expectedStatusCode)
    {
        $actualStatusCode = $this->client->getResponse()->getStatusCode();

        if ($actualStatusCode !== (int)$expectedStatusCode) {

            $this->getResponseJson();

            throw new \Exception(sprintf("Expected status code %s, got %s.", $expectedStatusCode, $actualStatusCode));
        }
    }

    /**
     * @Then the property :property exists in the response
     */
    public function thePropertyExistsInTheResponse($property)
    {
        if (!array_key_exists($property, $this->getResponseJson())) {
            throw new \Exception(sprintf("Expected '%s' property in response.", $property));
        }
    }

    /**
     * @Given an anonymous user
     */
    public function anAnonymousUser()
    {

    }
}