<?php

namespace App\Users\Entity;

class UserFactory
{
    public function make(UserId $id, $username, $email, $password)
    {
        return new User($id, $username, $email, $password);
    }
}
