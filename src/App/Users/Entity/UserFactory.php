<?php

namespace App\Users\Entity;

use Ramsey\Uuid\Uuid;

class UserFactory
{
    public function make($username, $email, $password)
    {
        $id = new UserId(Uuid::uuid4());

        return new User($id, $username, $email, $password);
    }
}
