<?php

namespace Dadamssg\DemoApp\Model\User\Repository;

use Dadamssg\DemoApp\Model\User\Entity\User;
use Dadamssg\DemoApp\Model\User\Value\ConfirmationToken;
use Dadamssg\DemoApp\Model\User\Value\Email;
use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;

interface UserRepository
{
    /**
     * @param UserId $id
     * @param Email $email
     * @param EncodedPassword $password
     * @return User
     */
    public function createUser(UserId $id, Email $email, EncodedPassword $password);

    /**
     * @param User $user
     */
    public function add(User $user);

    /**
     * @param UserId $id
     * @return User
     */
    public function findById(UserId $id);

    /**
     * @param ConfirmationToken $token
     * @return User
     */
    public function finddByConfirmationToken(ConfirmationToken $token);
}