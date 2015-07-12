<?php

namespace Dadamssg\DemoApp\Bundle\AppBundle\Validator;

use Dadamssg\DemoApp\Model\App\Validation\Error;
use Dadamssg\DemoApp\Model\App\Validation\Validator;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SymfonyValidator implements Validator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value)
    {
        $violations = $this->validator->validate($value);
        $errors = [];

        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $errors[] = new Error(
                $violation->getMessage(),
                $violation->getPropertyPath(),
                $violation->getCode()
            );
        }

        return $errors;
    }
}