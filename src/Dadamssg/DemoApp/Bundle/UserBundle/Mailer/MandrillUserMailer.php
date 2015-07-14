<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Mailer;

use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Mailer\UserMailer;
use Mandrill;

class MandrillUserMailer implements UserMailer
{
    /**
     * @var Mandrill
     */
    private $mandrill;

    /**
     * @var string
     */
    private $accountConfirmationTemplate;

    /**
     * @var string
     */
    private $passwordResetTemplate;

    /**
     * @param Mandrill $mandrill
     * @param $accountConfirmationTemplate
     * @param $passwordResetTemplate
     */
    public function __construct(Mandrill $mandrill, $accountConfirmationTemplate, $passwordResetTemplate)
    {
        $this->mandrill = $mandrill;
        $this->accountConfirmationTemplate = $accountConfirmationTemplate;
        $this->passwordResetTemplate = $passwordResetTemplate;
    }

    /**
     * @param User $user
     */
    public function sendAccountConfirmationEmail(User $user)
    {
        $message = [
            'subject' => 'Account Confirmation',
            'from_email' => 'robot@demoapp.com',
            'to' => [
                [
                    'email' => (string)$user->getEmail()
                ]
            ]
        ];

        $text = '<a href="https://demoapp.com/api/users/confirm/' . (string)$user->getConfirmationToken() . '">';
        $text .= 'Click this link to finish activating your account.';
        $text .= '</a>';

        $templateContent = [
            [
                'name' => 'main',
                'content' => $text
            ],
            [
                'name' => 'greeting',
                'content' => 'Howdy and welcome!'
            ]
        ];

        $this->mandrill->messages->sendTemplate($this->accountConfirmationTemplate, $templateContent, $message);
    }

    /**
     * @param User $user
     */
    public function sendPasswordResetEmail(User $user)
    {
        $message = [
            'subject' => 'Reset Password',
            'from_email' => 'robot@demoapp.com',
            'to' => [
                [
                    'email' => (string)$user->getEmail()
                ]
            ]
        ];

        $text = '<a href="https://demoapp.com/reset-password/' . (string)$user->getConfirmationToken() . '">';
        $text .= 'Click this link to to reset your password.';
        $text .= '</a>';

        $templateContent = [
            [
                'name' => 'main',
                'content' => $text
            ],
            [
                'name' => 'greeting',
                'content' => 'Hiya!'
            ]
        ];

        $this->mandrill->messages->sendTemplate($this->passwordResetTemplate, $templateContent, $message);
    }
}