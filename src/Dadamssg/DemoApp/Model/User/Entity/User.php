<?php

namespace Dadamssg\DemoApp\Model\User\Entity;

use Dadamssg\DemoApp\Model\User\Value\EncodedPassword;
use Dadamssg\DemoApp\Model\User\Value\UserId;

interface User
{
    /**
     * @return UserId
     */
    public function getId();

    /**
     * @param EncodedPassword $password
     */
    public function changePassword(EncodedPassword $password);

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled = true);

    /**
     * @return bool
     */
    public function isEnabled();
}