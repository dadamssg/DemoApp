<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Exception;

use Dadamssg\DemoApp\Model\App\Exception\DomainException;
use Dadamssg\DemoApp\Model\App\Exception\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class ExceptionClassMap
{
    private $statusCodeMap = [
        EntityNotFoundException::CLASS => Response::HTTP_NOT_FOUND,
        DomainException::CLASS => Response::HTTP_BAD_REQUEST,
    ];

    private $showMessages = [
        EntityNotFoundException::CLASS,
        DomainException::CLASS,
    ];

    /**
     * @param string $class
     * @return int
     */
    public function getStatusCode($class)
    {
        foreach ($this->statusCodeMap as $keyClass => $statusCode) {
            if ($keyClass === $class || is_subclass_of($class, $keyClass)) {
                return $this->statusCodeMap[$keyClass];
            }
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    /**
     * @param int $class
     * @return bool
     */
    public function canGetMessage($class)
    {
        foreach ($this->showMessages as $keyClass) {
            if ($keyClass === $class || is_subclass_of($class, $keyClass)) {
                return true;
            }
        }

        return false;
    }
}