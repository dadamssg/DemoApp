<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Controller;

use Dadamssg\DemoApp\Bundle\AppBundle\Exception\ExceptionClassMap;
use Dadamssg\DemoApp\Bundle\AppBundle\Form\ErrorExtractor;
use Dadamssg\DemoApp\Model\App\Exception\DomainException;
use Dadamssg\DemoApp\Model\App\Validation\Assertion;
use Dadamssg\DemoApp\Model\App\Validation\Error;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class AppController extends Controller
{
    /**
     * @var int
     */
    private $statusCode = Response::HTTP_OK;

    /**
     * @var array
     */
    private $data = array();

    /**
     * @var string
     */
    private $format = 'json';

    /**
     * @var array
     */
    private static $contentTypes = [
        'json' => 'application/json'
    ];

    /**
     * @param $code
     * @return $this
     */
    protected function setStatusCode($code)
    {
        $this->statusCode = (int)$code;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    protected function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return Response
     */
    protected function respond()
    {
        $data = $this->get('jms_serializer')->serialize($this->data, $this->format);

        $response = new Response($data, $this->statusCode);

        if (array_key_exists($this->format, self::$contentTypes)) {
            $response->headers->set('Content-Type', self::$contentTypes[$this->format]);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @param FormInterface $form
     */
    protected function submitJson(Request $request, FormInterface $form)
    {
        $data = json_decode($request->getContent(), true);

        if (is_array($data) && array_key_exists($form->getName(), $data)) {
            $form->submit($data[$form->getName()]);

            return;
        }

        throw new DomainException("Invalid request.");
    }

    /**
     * Respond with form errors.
     *
     * @param FormInterface $form
     * @return Response
     */
    protected function respondWithForm(FormInterface $form)
    {
        $errors = $this->getFormErrorExtractor()->extract($form);

        return $this->respondWithErrors($errors ?: ["Invalid request."]);
    }

    /**
     * @param \Traversable|Error[] $errorMessages
     * @return Response
     */
    protected function respondWithErrors($errorMessages)
    {
        Assertion::isTraversable($errorMessages, "Errors must be traversable.");

        $statusCode = Response::HTTP_BAD_REQUEST;
        $errors = [];

        foreach ($errorMessages as $error) {
            $errors[] = $this->formatError($error, $statusCode);
        }

        return $this->sendErrors($errors, $statusCode);
    }

    /**
     * @param string|Error $error
     * @param int $code
     * @return array
     */
    private function formatError($error, $code = Response::HTTP_BAD_REQUEST)
    {
        $field = $error instanceof Error ? $error->getField() : null;

        $statusTexts = Response::$statusTexts;

        return [
            "status_code" => $this->isValidStatusCode($code) ? $code : Response::HTTP_BAD_REQUEST,
            "status_text" => $this->isValidStatusCode($code) ? $statusTexts[$code] : $statusTexts[Response::HTTP_BAD_REQUEST],
            "message" => (string)$error,
            "field" => $field
        ];
    }

    /**
     * @param FlattenException $exception
     */
    public function showExceptionAction(FlattenException $exception)
    {
        $message = Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR];
        $class = $exception->getClass();
        $exceptionMap = new ExceptionClassMap();
        $statusCode = $exceptionMap->getStatusCode($class);

        if ($exceptionMap->canGetMessage($class) || !$this->isProduction()) {
            $message = $exception->getMessage();
        }

        $error = $this->formatError($message, $statusCode);

        return $this->sendErrors([$error], $statusCode);
    }

    /**
     * @param array $errors
     * @param int $statusCode
     * @return Response
     */
    private function sendErrors(array $errors, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        if (!$this->isValidStatusCode($statusCode)) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setData(['errors' => $errors])
            ->respond();
    }

    /**
     * @param int $statusCode
     * @return bool
     */
    private function isValidStatusCode($statusCode)
    {
        return in_array($statusCode, array_keys(Response::$statusTexts));
    }

    /**
     * Get the form error extractor.
     *
     * @return ErrorExtractor
     */
    protected function getFormErrorExtractor()
    {
        return $this->get("demo_app.app.form_error_extractor");
    }

    /**
     * @return bool
     */
    private function isProduction()
    {
        return $this->getParameter('kernel.environment') === 'prod';
    }

    /**
     * @return \SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware
     */
    protected function getCommandBus()
    {
        return $this->get('command_bus');
    }
}
