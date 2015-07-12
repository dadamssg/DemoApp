<?php

namespace Dadamssg\DemoApp\Model\User\Security;

use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\PlainPassword;
use Dadamssg\DemoApp\Model\User\Value\Salt;

interface PasswordEncoder
{
    /**
     * @param Salt $salt
     * @param PlainPassword $password
     * @return EncodedPassword
     */
    public function encode(Salt $salt, PlainPassword $password);
}