<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Mailer;

use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Mailer\UserMailer;

class NoOpUserMailer implements UserMailer
{
    /**
     * @param User $user
     */
    public function sendAccountConfirmationEmail(User $user)
    {
        // no-op
    }

    /**
     * @param User $user
     */
    public function sendPasswordResetEmail(User $user)
    {
        // no-op
    }
}