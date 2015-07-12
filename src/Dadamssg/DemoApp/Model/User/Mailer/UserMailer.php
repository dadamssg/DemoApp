<?php

namespace Dadamssg\DemoApp\Model\User\Mailer;

use Dadamssg\DemoApp\Model\User\Entity\User;

interface UserMailer
{
    /**
     * @param User $user
     */
    public function sendAccountConfirmationEmail(User $user);

    /**
     * @param User $user
     */
    public function sendPasswordResetEmail(User $user);
}