<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Controller;

use Dadamssg\DemoApp\Bundle\AppBundle\Controller\AppController;
use Dadamssg\DemoApp\Bundle\UserBundle\Form\Type\RegisterUserType;
use Dadamssg\DemoApp\Model\User\Command\EnableUser;
use Dadamssg\DemoApp\Model\User\Command\RegisterUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AppController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm($formType = new RegisterUserType());
        $this->submitJson($request, $form);

        if (!$form->isValid()) {
            return $this->respondWithForm($form);
        }

        /** @var RegisterUser $command */
        $command = $form->getData();
        $this->getCommandBus()->handle($command);

        if ($command->hasErrors()) {
            return $this->respondWithErrors($command->getErrors());
        }

        $message = "Please confirm your account by clicking on the link in the email that has just been sent to you.";

        return $this
            ->setStatusCode(Response::HTTP_CREATED)
            ->setData(['message' => $message])
            ->respond();
    }

    /**
     * @param string $token
     * @return Response
     */
    public function enableUserAction($token)
    {
        $command = new EnableUser($token);
        $this->getCommandBus()->handle($command);

        $message = "You have successfully confirmed and are free to login!";

        return $this
            ->setData(['message' => $message])
            ->respond();
    }
}
