<?php

namespace Dadamssg\DemoApp\Model\App\Validation\Middleware;

use Dadamssg\DemoApp\Model\App\Validation\HasErrors;
use Dadamssg\DemoApp\Model\App\Validation\Validator;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class CommandValidatorMiddleware implements MessageBusMiddleware
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($command, callable $next)
    {
        $traits = class_uses($command);

        // Command isn't worried about validation, continue on
        if ($traits === false || !in_array(HasErrors::CLASS, $traits)) {
            $next($command);
            return;
        }

        // Validate the command and bail if errors
        $errors = $this->validator->validate($command);
        if (count($errors) > 0) {
            $command->addErrors($errors);
            return;
        }

        // No errors, continue on
        $next($command);
    }
}