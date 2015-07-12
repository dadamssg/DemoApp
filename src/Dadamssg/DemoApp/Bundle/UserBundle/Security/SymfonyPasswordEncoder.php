<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Security;

use Dadamssg\DemoApp\Bundle\UserBundle\Entity\DoctrineUser;
use Dadamssg\DemoApp\Model\User\Security\PasswordEncoder;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\Salt;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class SymfonyPasswordEncoder implements PasswordEncoder
{
    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;
    /**
     * @param EncoderFactoryInterface $encoder
     */
    public function __construct(EncoderFactoryInterface $encoder)
    {
        $this->encoder = $encoder->getEncoder(DoctrineUser::CLASS);
    }
    /**
     * {@inheritdoc}
     */
    public function encode(Salt $salt, PlainPassword $password)
    {
        $encoded = $this->encoder->encodePassword((string)$password, (string)$salt);

        return new EncodedPassword($salt, $encoded);
    }
}